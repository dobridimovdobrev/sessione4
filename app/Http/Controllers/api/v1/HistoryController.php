<?php

namespace App\Http\Controllers\api\v1;

use App\Models\History;
use App\Helpers\ResponseMessages;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Resources\api\v1\HistoryResource;
use App\Http\Resources\api\v1\HistoryCollection;
use App\Http\Requests\api\v1\HistoryStoreRequest;
use App\Http\Requests\api\v1\HistoryUpdateRequest;

class HistoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $this->authorize('viewAny', History::class);

        $histories = History::paginate(100);
        return new HistoryCollection($histories);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(HistoryStoreRequest $request)
    {
        $user = Auth::user();

        // Check if history already exists for this content
        $history = History::where('user_id', $user->user_id)
            ->where('content_id', $request->input('content_id'))
            ->where('content_type', $request->input('content_type'))
            ->first();

        if (!$history) {
            // Create a new history entry
            $history = History::create([
                'user_id' => $user->user_id,
                'content_id' => $request->input('content_id'),
                'content_type' => $request->input('content_type'),
                'start_date' => now(),
                'progress' => 0,  // Start with 0% progress
            ]);

            return ResponseMessages::success(['message' => 'History created successfully', 'history' => new HistoryResource($history)], 201);
        }

        return ResponseMessages::error('History already exists for this content.', 400);
    }

    public function update(HistoryUpdateRequest $request, History $history)
    {
        $user = Auth::user();

        // Check if the user is allowed to update this history
        if ($user->user_id !== $history->user_id) {
            return ResponseMessages::error('Unauthorized', 403);
        }

        // Update the progress
        $history->progress = $request->input('progress', $history->progress);

        // If the user has finished watching, update the end_date
        if ($request->input('progress') == 100) {
            $history->end_date = now();
        }

        $history->save();

        return ResponseMessages::success(['message' => 'History updated successfully', 'history' => new HistoryResource($history)], 200);
    }

    public function show(History $history)
    {
        $this->authorize('view', $history);

        return new HistoryResource($history);
    }

    public function destroy(History $history)
    {
        $this->authorize('delete', $history);
        $history->delete();

        return ResponseMessages::success('History deleted successfully', 204);
    }
}
