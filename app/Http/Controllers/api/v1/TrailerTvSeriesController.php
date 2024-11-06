<?php

namespace App\Http\Controllers\api\v1;

use App\Helpers\ResponseMessages;
use App\Models\Trailer;
use App\Models\TvSerie;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TrailerTvSeriesController extends Controller
{
    // Attach a trailer to a TV series
    public function store(Request $request, $tvSeriesId)
    {
        $tvSeries = TvSerie::findOrFail($tvSeriesId);

        $request->validate([
            'trailers' => 'required|array',
            'trailers.*.url' => 'required|url'
        ]);

        foreach ($request->trailers as $trailerData) {
            $trailer = Trailer::create($trailerData);
            $tvSeries->trailers()->attach($trailer->trailer_id);
        }

        return ResponseMessages::success(['message' => 'Trailers attached successfully.'], 200);
    }

    // Detach a trailer from a TV series
    public function destroy($tvSeriesId, $trailerId)
    {
        $tvSeries = TvSerie::findOrFail($tvSeriesId);
        $tvSeries->trailers()->detach($trailerId);

        return ResponseMessages::success(['message' => 'Trailer detached successfully.'], 200);
    }

    // Get all trailers for a TV series
    public function index($tvSeriesId)
    {
        $tvSeries = TvSerie::findOrFail($tvSeriesId);
        $trailers = $tvSeries->trailers()->get();

        return ResponseMessages::success($trailers, 200);
    }
}
