<?php

namespace App\Http\Controllers\api\v1;

use App\Models\Person;
use App\Models\TvSerie;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PersonTvSeriesController extends Controller
{
    public function store(Request $request, $tvSeriesId)
    {
        $tvSeries = TvSerie::findOrFail($tvSeriesId);

        $request->validate([
            'person_ids' => 'required|array',
            'person_ids.*' => 'exists:persons,person_id'
        ]);

        $tvSeries->persons()->syncWithoutDetaching($request->person_ids);

        return response()->json(['message' => 'Persons attached successfully.'], 200);
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

        return response()->json($persons, 200);
    }
}
