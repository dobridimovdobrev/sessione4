<?php

namespace App\Http\Controllers\api\v1;

use App\Http\Controllers\Controller;
use App\Models\Episode;
use App\Models\Person;
use Illuminate\Http\Request;

class PersonEpisodeController extends Controller
{
    public function store(Request $request, $episodeId)
    {
        $episode = Episode::findOrFail($episodeId);

        $request->validate([
            'person_ids' => 'required|array',
            'person_ids.*' => 'exists:persons,person_id'
        ]);

        $episode->persons()->syncWithoutDetaching($request->person_ids);

        return response()->json(['message' => 'Persons attached to episode successfully.'], 200);
    }

    public function destroy($episodeId, $personId)
    {
        $episode = Episode::findOrFail($episodeId);
        $episode->persons()->detach($personId);

        return response()->json(['message' => 'Person detached from episode successfully.'], 200);
    }

    public function index($episodeId)
    {
        $episode = Episode::findOrFail($episodeId);
        $persons = $episode->persons()->get();

        return response()->json($persons, 200);
    }
}
