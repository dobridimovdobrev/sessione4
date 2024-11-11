<?php

namespace App\Http\Controllers\api\v1;

use App\Helpers\ResponseMessages;
use App\Http\Controllers\Controller;
use App\Models\Season;
use App\Models\Trailer;
use Illuminate\Http\Request;

class TrailerSeasonController extends Controller
{
    public function store(Request $request, $seasonId)
    {
        $season = Season::findOrFail($seasonId);

        $request->validate([
            'trailer_ids' => 'required|array',
             'trailer_ids.*' => 'exists:trailers,trailer_id'
        ]);

        foreach ($request->trailers as $trailerData) {
            $trailer = Trailer::create($trailerData);
            $season->trailers()->attach($trailer->trailer_id);
        }

        return ResponseMessages::success(['message' => 'Trailers attached to season successfully.'], 200);
    }

    public function destroy($seasonId, $trailerId)
    {
        $season = Season::findOrFail($seasonId);
        $season->trailers()->detach($trailerId);

        return ResponseMessages::success(['message' => 'Trailer detached from season successfully.'], 200);
    }

    public function index($seasonId)
    {
        $season = Season::findOrFail($seasonId);
        $trailers = $season->trailers()->get();

        return ResponseMessages::success($trailers, 200);
    }
}

