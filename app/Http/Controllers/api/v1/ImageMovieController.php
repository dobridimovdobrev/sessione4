<?php

namespace App\Http\Controllers\api\v1;

use App\Models\Movie;
use App\Models\ImageFile;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ImageMovieController extends Controller
{
     // Attach images to a movie
     public function store(Request $request, $movieId)
     {
         $movie = Movie::findOrFail($movieId);
 
         // Validate image ids
         $request->validate([
             'image_ids' => 'required|array',
             'image_ids.*' => 'exists:image_files,image_id'
         ]);
 
         // Attach images to the movie
         $movie->imageFiles()->syncWithoutDetaching($request->image_ids);
 
         return response()->json(['message' => 'Images associated successfully.'], 200);
     }
 
     // Detach an image from a movie
     public function destroy($movieId, $imageId)
     {
         $movie = Movie::findOrFail($movieId);
         $movie->imageFiles()->detach($imageId);
 
         return response()->json(['message' => 'Image detached successfully.'], 200);
     }
 
     // Show all images attached to a movie
     public function index($movieId)
     {
         $movie = Movie::findOrFail($movieId);
         $images = $movie->imageFiles()->get();
 
         return response()->json($images, 200);
     }
 
     // Show all movies for an image
     public function show($imageId)
     {
         $image = ImageFile::findOrFail($imageId);
         $movies = $image->movies()->get();
 
         return response()->json($movies, 200);
     }
}
