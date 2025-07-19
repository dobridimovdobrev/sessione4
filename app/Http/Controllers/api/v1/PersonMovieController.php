<?php

namespace App\Http\Controllers\api\v1;

use App\Models\Movie;
use App\Models\Person;

use Illuminate\Http\Request;
use App\Helpers\ResponseMessages;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
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
       // Get the role of the authenticated user
    $userRole = Auth::user()->role->role_name;

    // Retrieve all movies for the person with filtering
    $moviesQuery = $person->movies();

    // Apply filtering to exclude draft movies for regular users
    if ($userRole === 'user') {
        $moviesQuery->whereIn('status', ['published', 'coming soon']);
    }

    // Execute the query and get the movies
    $movies = $moviesQuery->get();

    return new MovieCollection($movies);

      
   }

}
