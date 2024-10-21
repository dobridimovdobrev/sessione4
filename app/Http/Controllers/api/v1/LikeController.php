<?php

namespace App\Http\Controllers\api\v1;

use App\Models\Like;
use Illuminate\Http\Request;
use App\Helpers\ResponseMessages;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Resources\api\v1\LikeResource;
use App\Http\Resources\api\v1\LikeCollection;
use App\Http\Requests\api\v1\LikeStoreRequest;

class LikeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $this->authorize('viewAny', Like::class);
        $likes = Like::all();
        return new LikeCollection($likes);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(LikeStoreRequest $request)
    {
        $this->authorize('create', Like::class);
        $validatedData = $request->validated();
         // Check if the content is already liked by the user
         $existingLike = Like::where('user_id', Auth::id())
         ->where('content_id', $validatedData['content_id'])
         ->where('content_type', $validatedData['content_type'])
         ->first();

     if ($existingLike) {
         return ResponseMessages::error('Content already liked.', 400);
     }      

     // Create the like
     $like = Like::create([
         'user_id' => Auth::id(),
         'content_id' => $validatedData['content_id'],
         'content_type' => $validatedData['content_type'],
     ]);

     return ResponseMessages::success(['message' => 'Content liked successfully', 'like' => new LikeResource($like)], 201);
 
    }

    /**
     * Display the specified resource.
     */
    public function show(Like $like)
    {
        
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Like $like)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Like $like)
    {
        $this->authorize('delete', $like);
        $like->delete();
        return ResponseMessages::success('Like removed successfully', 204);
    }
}
