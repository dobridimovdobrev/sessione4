<?php

namespace App\Http\Controllers\api\v1;

use App\Models\TvSerie;
use Illuminate\Http\Request;
use App\Helpers\ResponseMessages;
use App\Http\Controllers\Controller;
use App\Http\Resources\api\v1\TvSeriesResource;
use App\Http\Resources\api\v1\TvSeriesCollection;
use App\Http\Requests\api\v1\TvSeriesStoreRequest;
use App\Http\Requests\api\v1\TvSeriesUpdateRequest;

class TvSerieController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $this->authorize('viewAny', TvSerie::class);
        $filterData = $request->all();
        $query = TvSerie::query();

        foreach ($filterData as $key => $value) {
            if (in_array($key, ['title', 'year', 'status', 'description', 'year', 'imdb_rating', 'category_id'])) {
                $query->where($key, $value);
            }
        }

        $tvSeries = $query->paginate(20);
        return new TvSeriesCollection($tvSeries);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(TvSeriesStoreRequest $request)
    {
        $this->authorize('create', TvSerie::class);
        $validatedData = $request->validated();
        $tvSeries = TvSerie::create($validatedData);
        return ResponseMessages::success(['message' => 'TV Series created successfully', 'tv_series' => new TvSeriesResource($tvSeries)], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(TvSerie $tvSerie)
    {
        $this->authorize('view', $tvSerie);

         // Eager load the related data (category,persons, trailers, , images)
         $tvSerieData = TvSerie::with(['category','persons', 'imageFiles'])->findOrFail($tvSerie->tv_series_id);
         return new TvSeriesResource($tvSerieData);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(TvSeriesUpdateRequest $request, TvSerie $tvSerie)
    {
        $this->authorize('update', $tvSerie);
        $validatedData = $request->validated();
        $tvSerie->update($validatedData);
        return ResponseMessages::success(['message' => 'TV Series updated successfully', 'tv_series' => new TVSeriesResource($tvSerie)], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(TvSerie $tvSerie)
    {
        $this->authorize('delete', $tvSerie);
        $tvSerie->delete();
        return ResponseMessages::success('TV Serie is deleted successfully', 204);
    }
}
