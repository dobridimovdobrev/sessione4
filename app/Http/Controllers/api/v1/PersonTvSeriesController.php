<?php

namespace App\Http\Controllers\api\v1;

use App\Models\Person;
use App\Models\TvSerie;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\api\v1\PersonTvSeriesCollection;
use App\Http\Resources\api\v1\PersonTvSeriesResource;
use App\Http\Resources\api\v1\TvSeriesCollection;

class PersonTvSeriesController extends Controller
{
    public function store(Request $request, $tvSeriesId)
    {

        $tvSeries = TvSerie::findOrFail($tvSeriesId);

        // Validate that 'names' is an array of person names
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

        // Attach the found or created persons to the TV series
        $tvSeries->persons()->syncWithoutDetaching($personIds);

        return response()->json(['message' => 'Persons associated successfully.'], 200);

    }

    public function destroy($tvSeriesId, $personId)
    {
        $tvSeries = TvSerie::findOrFail($tvSeriesId);
        $tvSeries->persons()->detach($personId);

        return response()->json(['message' => 'Person detached successfully.'], 200);
    }

    public function index($tvSeriesId)
    {
        $tvSeries = TvSerie::findOrFail($tvSeriesId);
        $persons = $tvSeries->persons()->get();

        return new PersonTvSeriesCollection($persons);
    }
}
