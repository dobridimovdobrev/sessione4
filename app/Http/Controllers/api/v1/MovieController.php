<?php

namespace App\Http\Controllers\api\v1;

use App\Models\Movie;
use App\Models\Trailer;
use App\Models\ImageFile;
use App\Models\VideoFile;
use Illuminate\Http\Request;
use App\Helpers\ResponseMessages;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Resources\api\v1\MovieResource;
use App\Http\Resources\api\v1\MovieCollection;
use App\Http\Requests\api\v1\MovieStoreRequest;
use App\Http\Requests\api\v1\MovieUpdateRequest;


class MovieController extends Controller
{

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // Authorization for viewing movies
        $this->authorize('viewAny', Movie::class);
    
        // Apply filters if any
        $filterData = $request->all();
        $query = Movie::query();
    
        // User can see only published and coming soon movies but not draft
        if (Auth::user()->role->role_name === 'user') {
            $query->whereIn('status', ['published', 'coming soon']);
        }
    
        // Filter movies by different parameters/keys
        foreach ($filterData as $key => $value) {
            if (in_array($key, ['movie_id', 'title', 'description', 'year', 'duration', 'imdb_rating', 'status', 'category_id'])) {
                $query->where($key, $value);
            }
        }
    
        // Execute the query and get the results
        $movies = $query->get();
    
        return response()->json($movies);
    }
    

    /**
     * Store a newly created resource in storage.
     */
    public function store(MovieStoreRequest $request)
{
    // Authorization for creating a movie
    $this->authorize('create', Movie::class);

    $validatedData = $request->validated();

    // Create the movie
    $movie = Movie::create($validatedData);

    // Attach persons (actors) to the movie
    if ($request->has('persons')) {
        $movie->persons()->sync($request->persons);
    }

    // Attach trailers
    if ($request->has('trailers')) {
        foreach ($request->trailers as $trailerData) {
            $trailer = Trailer::create($trailerData);
            $movie->trailers()->attach($trailer->trailer_id);
        }
    }

    // Attach video files
    if ($request->has('video_files')) {
        foreach ($request->video_files as $videoData) {
            $videoFile = VideoFile::create($videoData);
            $movie->videoFiles()->attach($videoFile->video_file_id);
        }
    }

    // Attach image files
    if ($request->has('image_files')) {
        foreach ($request->image_files as $imageData) {
            $imageFile = ImageFile::create($imageData);
            $movie->imageFiles()->attach($imageFile->image_id);
        }
    }

    return ResponseMessages::success(['message' => 'Movie created successfully', 'movie' => new MovieResource($movie)], 201);
}


    /**
     * Display the specified resource.
     */
    public function show(Movie $movie)
    {
        //authorization for view a movie
        $this->authorize('view', $movie);
        if(Auth::user()->role->role_name === 'user' && !in_array($movie->status,['published','coming soon'])){
            ResponseMessages::error('You are not authorized', 403);
        }
         // Eager load the related data (category, persons, trailers, videos, images)
        $movieData = Movie::with(['category','persons', 'trailers', 'videoFiles', 'imageFiles'])->findOrFail($movie->movie_id);
        return new MovieResource($movieData);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(MovieUpdateRequest $request, Movie $movie)
    {
        //authorization for update a movie
        $this->authorize('update', $movie);
        $validatedData = $request->validated();
        $movie->update($validatedData);
        return ResponseMessages::success(['message' => 'Movie successfully updated', 'movie' => new MovieResource($movie)], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Movie $movie)
    {
        //authorization for delete movie
        $this->authorize('delete', $movie);
        $movie->delete();

        return ResponseMessages::success('Movie deleted successfully', 204);
    }

    // Method to associate persons to a movie
    public function attachPersons(Request $request, $movieId)
    {
        $movie = Movie::findOrFail($movieId);

        // Validate the request
        $request->validate([
            'person_ids' => 'required|array',
            'person_ids.*' => 'exists:persons,person_id'
        ]);

        // Attach persons to the movie
        $movie->persons()->syncWithoutDetaching($request->person_ids);

        return response()->json(['message' => 'Persons associated successfully.'], 200);
    }

    // Method to associate trailers to a movie
    public function attachTrailers(Request $request, $movieId)
    {
        $movie = Movie::findOrFail($movieId);

        // Validate the request
        $request->validate([
            'trailers' => 'required|array',
            'trailers.*.url' => 'required|url'
        ]);

        // Attach trailers to the movie
        foreach ($request->trailers as $trailerData) {
            $trailer = Trailer::create($trailerData);
            $movie->trailers()->attach($trailer->id);
        }

        return response()->json(['message' => 'Trailers associated successfully.'], 200);
    }

    // Method to associate video files to a movie
    public function attachVideos(Request $request, $movieId)
    {
        $movie = Movie::findOrFail($movieId);

        // Validate the request
        $request->validate([
            'videos' => 'required|array',
            'videos.*.url' => 'required|url',
            'videos.*.format' => 'required|string',
            'videos.*.size' => 'required|integer'
        ]);

        // Attach video files to the movie
        foreach ($request->videos as $videoData) {
            $video = VideoFile::create($videoData);
            $movie->videoFiles()->attach($video->id);
        }

        return response()->json(['message' => 'Videos associated successfully.'], 200);
    }

    // Method to associate image files to a movie
    public function attachImages(Request $request, $movieId)
    {
        $movie = Movie::findOrFail($movieId);

        // Validate the request
        $request->validate([
            'images' => 'required|array',
            'images.*.url' => 'required|url',
            'images.*.format' => 'required|string',
            'images.*.size' => 'required|integer'
        ]);

        // Attach image files to the movie
        foreach ($request->images as $imageData) {
            $image = ImageFile::create($imageData);
            $movie->imageFiles()->attach($image->id);
        }

        return response()->json(['message' => 'Images associated successfully.'], 200);
    }
}
