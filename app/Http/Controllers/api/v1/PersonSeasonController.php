<?php

namespace App\Http\Controllers\api\v1;

use App\Http\Controllers\Controller;
use App\Models\Season;
use App\Models\Person;
use Illuminate\Http\Request;

class PersonSeasonController extends Controller
{
    public function store(Request $request, $seasonId)
    {
        $season = Season::findOrFail($seasonId);

        $request->validate([
            'person_ids' => 'required|array',
            'person_ids.*' => 'exists:persons,person_id'
        ]);

        $season->persons()->syncWithoutDetaching($request->person_ids);

        return response()->json(['message' => 'Persons attached to season successfully.'], 200);
    }

    public function destroy($seasonId, $personId)
    {
        $season = Season::findOrFail($seasonId);
        $season->persons()->detach($personId);

        return response()->json(['message' => 'Person detached from season successfully.'], 200);
    }

    public function index($seasonId)
    {
        $season = Season::findOrFail($seasonId);
        $persons = $season->persons()->get();

        return response()->json($persons, 200);
    }
}
