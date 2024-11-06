<?php

namespace App\Http\Controllers\api\v1;

use App\Models\Episode;
use Illuminate\Http\Request;
use App\Helpers\ResponseMessages;
use App\Http\Controllers\Controller;
use App\Http\Resources\api\v1\EpisodeResource;
use App\Http\Resources\api\v1\EpisodeCollection;
use App\Http\Requests\api\v1\EpisodeStoreRequest;
use App\Http\Requests\api\v1\EpisodeUpdateRequest;

class EpisodeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $this->authorize('viewAny', Episode::class);
        $filterData = $request->all();
        $query = Episode::query();
        foreach($filterData as $key => $value){
            if(in_array($key,['season_id', 'episode_id', 'title', 'episode_number', 'status'])){
               $query = $query->where($key,'LIKE', "%$value%");
            }
        }
        $episodes = $query->paginate(20);
        return new EpisodeCollection($episodes);
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(EpisodeStoreRequest $request)
    {
        $this->authorize('create', Episode::class);
        $validatedData = $request->validated();
        $episode = Episode::create($validatedData);

        return ResponseMessages::success(
            ['message' => 'Episode created successfully', 'episode' => new EpisodeResource($episode)], 
            201
        );
    }

    /**
     * Display the specified resource.
     */
    public function show(Episode $episode)
    {
        $this->authorize('view', $episode);
        $episodeData = Episode::with(['persons', 'videoFiles', 'imageFiles'])->findOrFail($episode->episode_id);
        return new EpisodeResource($episodeData);
    }

    /**
     * Update the specified resource in storage.
     */
     public function update(EpisodeUpdateRequest $request, Episode $episode)
    {
        $this->authorize('update', $episode);
        $validatedData = $request->validated();
        $episode->update($validatedData);

        return ResponseMessages::success(
            ['message' => 'Episode updated successfully', 'episode' => new EpisodeResource($episode)], 
            200
        );
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Episode $episode)
    {
        $this->authorize('delete', $episode);
        $episode->delete();
        return ResponseMessages::success('Episode deleted successfully', 204);
    }
}
