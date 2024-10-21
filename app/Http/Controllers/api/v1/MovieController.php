<?php

namespace App\Http\Controllers\api\v1;

use App\Models\Movie;
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
        $query = Movie::query();  // Create the base query

        //user can see only published and coming soon movies but not draft
        if(Auth::user()->role->role_name === 'user'){
            $query->whereIn('status',['published', 'coming soon']);
        }
        //filter movies by different parameters/keys
        foreach ($filterData as $key => $value) {
            if (in_array($key, ['movie_id', 'title', 'description', 'year', 'duration', 'imdb_rating', 'status', 'category_id'])) {
                $query->where($key, $value);
            }
        }

        // Fetch all movies or filtered ones
        $movies = $query->paginate(20);

        // Return the full collection
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
        $movie = Movie::create($validatedData);
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
        return new MovieResource($movie);
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
}
