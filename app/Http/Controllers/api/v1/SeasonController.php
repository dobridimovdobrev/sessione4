<?php

namespace App\Http\Controllers\api\v1;

use App\Models\Season;
use Illuminate\Http\Request;
use App\Helpers\ResponseMessages;
use App\Http\Controllers\Controller;
use App\Http\Resources\api\v1\SeasonResource;
use App\Http\Resources\api\v1\SeasonCollection;
use App\Http\Requests\api\v1\SeasonStoreRequest;
use App\Http\Requests\api\v1\SeasonUpdateRequest;

class SeasonController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $this->authorize('viewAny', Season::class);
        $seasons = Season::paginate(100);
        return new SeasonCollection($seasons);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(SeasonStoreRequest $request)
    {
        $this->authorize('create', Season::class);
        $validatedData = $request->validated();
        $season = Season::create($validatedData);

        return ResponseMessages::success(
            ['message' => 'Season created successfully', 'season' => new SeasonResource($season)],201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Season $season)
    {   
        $this->authorize('view', $season);
        return new SeasonResource($season);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(SeasonUpdateRequest $request, Season $season)
    {
        $this->authorize('update', $season);
        $validatedData = $request->validated();
        $season->update($validatedData);

        return ResponseMessages::success(
            ['message' => 'Season updated successfully', 'season' => new SeasonResource($season)], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Season $season)
    {
        $this->authorize('delete', $season);
        $season->delete();
        return ResponseMessages::success('Season deleted successfully', 204);
    }
}
