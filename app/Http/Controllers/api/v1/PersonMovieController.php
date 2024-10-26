<?php

namespace App\Http\Controllers\api\v1;
use App\Models\Movie;

use App\Models\Person;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PersonMovieController extends Controller
{
   // Attach a person to a movie
   public function store(Request $request, $movieId)
   {
       $movie = Movie::findOrFail($movieId);

       // Validate person ids
       $request->validate([
           'person_ids' => 'required|array',
           'person_ids.*' => 'exists:persons,person_id'
       ]);

       // Attach persons to the movie
       $movie->persons()->syncWithoutDetaching($request->person_ids);

       return response()->json(['message' => 'Persons associated successfully.'], 200);
   }

   // Detach a person from a movie
   public function destroy($movieId, $personId)
   {
       $movie = Movie::findOrFail($movieId);
       $movie->persons()->detach($personId);

       return response()->json(['message' => 'Person detached successfully.'], 200);
   }

   

   // Show all movies for a person
   public function show($personId)
   {
       $person = Person::findOrFail($personId);
       $movies = $person->movies()->get(); // Retrieve all movies for the person

       return response()->json($movies, 200);
   }

}
