<?php

namespace App\Http\Controllers\api\v1;

use App\Models\Movie;
use App\Models\Trailer;
use App\Models\ImageFile;
use App\Models\VideoFile;
use Illuminate\Http\Request;
use App\Helpers\ResponseMessages;
use App\Helpers\FileUploadHelper;
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
    
        // Initialize query with eager loading for basic movie data
        $query = Movie::query()
            ->with(['category', 'imageFiles' => function($query) {
                $query->wherePivot('type', 'poster')->limit(1);
            }]);
    
        // User can see only published and coming soon movies but not draft
        if (Auth::user()->role->role_name === 'user') {
            $query->whereIn('status', ['published', 'coming soon']);
        }
    
        // Apply filters from request parameters
        $filterData = $request->all();
        foreach ($filterData as $key => $value) {
            if (in_array($key, ['movie_id', 'title', 'year', 'duration', 'imdb_rating', 'status', 'category_id'])) {
                $query->where($key, 'LIKE', "%$value%");
            }
        }
    
        // Execute query with pagination (24 items per page)
        $movies = $query->paginate(20);
    
        return new MovieCollection($movies);
    }
    

    /**
     * Store a newly created resource in storage.
     */
    public function store(MovieStoreRequest $request)
{
    // Authorization for creating a movie
    $this->authorize('create', Movie::class);

    $validatedData = $request->validated();
    
    $fileFields = [
        'trailer_video', 'movie_video'
    ];
    $movieData = collect($validatedData)->except($fileFields)->toArray();

    // Create the movie
    $movie = Movie::create($movieData);

    // Handle poster and backdrop URLs directly
    // These are already uploaded via /api/v1/upload/image endpoint
    
    // 1. Poster URL - find existing ImageFile by URL
    if ($request->has('poster')) {
        $posterImage = ImageFile::where('url', 'LIKE', '%' . basename($request->poster) . '%')
                                ->where('type', 'poster')
                                ->first();
        if ($posterImage) {
            $movie->imageFiles()->attach($posterImage->image_id, ['type' => 'poster']);
        }
    }

    // 2. Backdrop URL - find existing ImageFile by URL
    if ($request->has('backdrop')) {
        $backdropImage = ImageFile::where('url', 'LIKE', '%' . basename($request->backdrop) . '%')
                                  ->where('type', 'backdrop')
                                  ->first();
        if ($backdropImage) {
            $movie->imageFiles()->attach($backdropImage->image_id, ['type' => 'backdrop']);
        }
    }

    // upload video
    
    // 1. Trailer video
    if ($request->hasFile('trailer_video')) {
        $trailerFile = $request->file('trailer_video');
        $fileData = FileUploadHelper::uploadVideo($trailerFile);
        
        //automatic generation of title description
        $trailerTitle = $request->title . ' - Trailer';
        
        $trailerVideo = VideoFile::create([
            'url' => $fileData['url'],
            'title' => $trailerTitle, // Il titolo contiene 'Trailer' per identificarlo
            'format' => $fileData['format'] ?? 'mp4', // Default format if missing
            'resolution' => isset($fileData['width']) && isset($fileData['height']) ? $fileData['width'].'x'.$fileData['height'] : null,
        ]);
        
        $movie->videoFiles()->attach($trailerVideo->video_file_id);
    }

    // 2. Movie video
    if ($request->hasFile('movie_video')) {
        $movieFile = $request->file('movie_video');
        $fileData = FileUploadHelper::uploadVideo($movieFile);
        
        // automatic generation of title description
        $movieTitle = $request->title . ' - Full Movie';
        
        $movieVideo = VideoFile::create([
            'url' => $fileData['url'],
            'title' => $movieTitle, // Il titolo contiene 'Full Movie' per identificarlo
            'format' => $fileData['format'] ?? 'mp4', // Default format if missing
            'resolution' => isset($fileData['width']) && isset($fileData['height']) ? $fileData['width'].'x'.$fileData['height'] : null,
        ]);
        
        $movie->videoFiles()->attach($movieVideo->video_file_id);
    }


    
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
            // If video_file_id is provided, attach existing video file
            if (isset($videoData['video_file_id'])) {
                $movie->videoFiles()->attach($videoData['video_file_id']);
            } else {
                // Create new video file if full data is provided
                // Set automatic type if not provided
                if (!isset($videoData['type'])) {
                    $videoData['type'] = 'movie'; // Default type for additional video files
                }
                $videoFile = VideoFile::create($videoData);
                $movie->videoFiles()->attach($videoFile->video_file_id);
            }
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
        $this->authorize('view', $movie);

        // Eager load all relationships for detailed view
        $movie->load([
            'category',
            'persons.imageFiles',  // Eager load imageFiles with persons
            'trailers',
            'imageFiles',
            'videoFiles'  // Load video files for streaming
        ]);

        return new MovieResource($movie);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(MovieUpdateRequest $request, Movie $movie)
    {
        // Authorization for update a movie
        $this->authorize('update', $movie);
        
        $validatedData = $request->validated();
        
        // Rimuovi i campi dei file dalla validatedData per aggiornare il film
        $fileFields = [
            'poster_image', 'backdrop_image', 'trailer_video', 'movie_video'
        ];
        $movieData = collect($validatedData)->except($fileFields)->toArray();
        
        // Update the movie
        $movie->update($movieData);
        
        // Gestione dell'aggiornamento delle immagini
        
        // 1. Poster image
        if ($request->hasFile('poster_image')) {
            // Trova e rimuovi l'associazione con il poster esistente
            $existingPosters = $movie->imageFiles()->wherePivot('type', 'poster')->get();
            foreach ($existingPosters as $existingPoster) {
                $movie->imageFiles()->detach($existingPoster->image_id);
                // Qui potresti anche eliminare il file se non è usato da altri record
            }
            
            // Carica il nuovo poster
            $posterFile = $request->file('poster_image');
            $fileData = FileUploadHelper::uploadImage($posterFile, 'poster');
            
            // Automatic generation of title description
            $posterTitle = $request->title . ' - Poster';
            $posterDescription = 'Poster for ' . $request->title;
            
            $posterImage = ImageFile::create([
                'url' => $fileData['url'],
                'title' => $posterTitle,
                'description' => $posterDescription,
                'format' => $fileData['format'],
                'type' => 'poster',
                'size' => $fileData['size'],
                'width' => $fileData['width'],
                'height' => $fileData['height'],
            ]);
            
            $movie->imageFiles()->attach($posterImage->image_id, ['type' => 'poster']);
        }
        
        // 2. Backdrop image
        if ($request->hasFile('backdrop_image')) {
            // Trova e rimuovi l'associazione con il backdrop esistente
            $existingBackdrops = $movie->imageFiles()->wherePivot('type', 'backdrop')->get();
            foreach ($existingBackdrops as $existingBackdrop) {
                $movie->imageFiles()->detach($existingBackdrop->image_id);
                // Qui potresti anche eliminare il file se non è usato da altri record
            }
            
            // Carica il nuovo backdrop
            $backdropFile = $request->file('backdrop_image');
            $fileData = FileUploadHelper::uploadImage($backdropFile, 'backdrop');
            
            // Automatic generation of title description
            $backdropTitle = $request->title . ' - Backdrop';
            $backdropDescription = 'Backdrop for ' . $request->title;
            
            $backdropImage = ImageFile::create([
                'url' => $fileData['url'],
                'title' => $backdropTitle,
                'description' => $backdropDescription,
                'format' => $fileData['format'],
                'type' => 'backdrop',
                'size' => $fileData['size'],
                'width' => $fileData['width'],
                'height' => $fileData['height'],
            ]);
            
            $movie->imageFiles()->attach($backdropImage->image_id, ['type' => 'backdrop']);
        }
        
        // Upload video
        
        // 1. Trailer video
        if ($request->hasFile('trailer_video')) {
            // Disassocia tutti i trailer esistenti
            // Poiché non abbiamo un campo 'type' né nella tabella pivot né nella tabella video_files,
            // dobbiamo identificare i trailer in base al titolo (che contiene 'Trailer')
            $existingTrailers = $movie->videoFiles()->whereRaw("LOWER(title) LIKE '%trailer%'")->get();
            foreach ($existingTrailers as $existingTrailer) {
                $movie->videoFiles()->detach($existingTrailer->video_file_id);
                // Qui potresti anche eliminare il file se non è usato da altri record
            }
            
            // Carica il nuovo trailer
            $trailerFile = $request->file('trailer_video');
            $fileData = FileUploadHelper::uploadVideo($trailerFile);
            
            // Automatic generation of title description
            $trailerTitle = $request->title . ' - Trailer';
            $trailerDescription = 'Trailer for ' . $request->title;
            
            $trailerVideo = VideoFile::create([
                'url' => $fileData['url'],
                'title' => $trailerTitle, // Il titolo contiene 'Trailer' per identificarlo
                'format' => $fileData['format'],
                'resolution' => isset($fileData['width']) && isset($fileData['height']) ? $fileData['width'].'x'.$fileData['height'] : null,
            ]);
            
            $movie->videoFiles()->attach($trailerVideo->video_file_id);
        }
        
        // 2. Movie video
        if ($request->hasFile('movie_video')) {
            // Disassocia tutti i video esistenti
            // Poiché non abbiamo un campo 'type' né nella tabella pivot né nella tabella video_files,
            // dobbiamo identificare i video in base al titolo (che contiene 'Full Movie')
            $existingMovieVideos = $movie->videoFiles()->whereRaw("LOWER(title) LIKE '%full movie%'")->get();
            foreach ($existingMovieVideos as $existingMovieVideo) {
                $movie->videoFiles()->detach($existingMovieVideo->video_file_id);
                // Qui potresti anche eliminare il file se non è usato da altri record
            }
            
            // Carica il nuovo video
            $movieFile = $request->file('movie_video');
            $fileData = FileUploadHelper::uploadVideo($movieFile);
            
            // Automatic generation of title description
            $movieTitle = $request->title . ' - Full Movie';
            $movieDescription = 'Full movie for ' . $request->title;
            
            $movieVideo = VideoFile::create([
                'url' => $fileData['url'],
                'title' => $movieTitle, // Il titolo contiene 'Full Movie' per identificarlo
                'format' => $fileData['format'],
                'resolution' => isset($fileData['width']) && isset($fileData['height']) ? $fileData['width'].'x'.$fileData['height'] : null,
            ]);
            
            $movie->videoFiles()->attach($movieVideo->video_file_id);
        }
        
        // Attach persons (actors) to the movie if provided
        if ($request->has('persons')) {
            $movie->persons()->sync($request->persons);
        }
        
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

        return ResponseMessages::success (['message' => 'Persons associated successfully.'], 200);
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

        return ResponseMessages::success (['message' => 'Trailers associated successfully.'], 200);
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

        return ResponseMessages::success (['message' => 'Videos associated successfully.'], 200);
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

        return ResponseMessages::success (['message' => 'Images associated successfully.'], 200);
    }
}
