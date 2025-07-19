<?php

namespace App\Http\Controllers\api\v1;

use App\Helpers\ResponseMessages;
use App\Models\Movie;
use App\Models\Trailer;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TrailerMovieController extends Controller
{
     // Attach trailers to a movie
     public function store(Request $request, $movieId)
     {
         $movie = Movie::findOrFail($movieId);
 
         // Validate trailer ids
         $request->validate([
             'trailer_ids' => 'required|array',
             'trailer_ids.*' => 'exists:trailers,trailer_id'
         ]);
 
         // Attach trailers to the movie
         $movie->trailers()->syncWithoutDetaching($request->trailer_ids);
 
         return ResponseMessages::success(['message' => 'Trailers associated successfully.'], 200);
     }
 
     // Detach a trailer from a movie
     public function destroy($movieId, $trailerId)
     {
         $movie = Movie::findOrFail($movieId);
         $movie->trailers()->detach($trailerId);
 
         return ResponseMessages::success(['message' => 'Trailer detached successfully.'], 200);
     }
 
     // Show all trailers attached to a movie
     public function index($movieId)
     {
         $movie = Movie::findOrFail($movieId);
         $trailers = $movie->trailers()->get();
 
         return ResponseMessages::success($trailers, 200);
     }
 
     // Show all movies for a trailer
     public function show($trailerId)
     {
         $trailer = Trailer::findOrFail($trailerId);
         $movies = $trailer->movies()->get();
 
         return response()->json($movies, 200);
     }
}
