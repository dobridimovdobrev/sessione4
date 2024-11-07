<?php

namespace App\Http\Controllers\api\v1;

use App\Helpers\ResponseMessages;
use App\Models\Movie;

use App\Models\Person;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\api\v1\MovieCollection;


class PersonMovieController extends Controller
{
   // Attach a person to a movie
   public function store(Request $request, $movieId)
   {
       $movie = Movie::findOrFail($movieId);

       // Validate person ids
       $request->validate([
           'names' => 'required|array',
            'names.*' => 'string'
       ]);

       $personIds = [];

        // Loop through each person name, find or create the person, and store their ID
        foreach ($request->input('names') as $name) {
            $person = Person::firstOrCreate(['name' => $name]);
            $personIds[] = $person->person_id;
        }

        // Attach the found or created persons to movie
        $movie->persons()->syncWithoutDetaching($personIds);

       return ResponseMessages::success(['message' => 'Persons associated successfully.'], 200);
   }

   // Detach a person from a movie
   public function destroy($movieId, $personId)
   {
       $movie = Movie::findOrFail($movieId);
       $movie->persons()->detach($personId);

       return ResponseMessages::success(['message' => 'Person detached successfully.'], 200);
   }

   

   // Show all movies for a person
   public function index($personId)
   {
       $person = Person::findOrFail($personId);
       $movies = $person->movies()->get(); // Retrieve all movies for the person

       return new MovieCollection($movies);
   }

}
