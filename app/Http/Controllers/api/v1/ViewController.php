<?php

namespace App\Http\Controllers\api\v1;

use App\Models\View;
use Illuminate\Http\Request;
use App\Helpers\ResponseMessages;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Resources\api\v1\ViewResource;
use App\Http\Resources\api\v1\ViewCollection;
use App\Http\Requests\api\v1\ViewStoreRequest;

class ViewController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $this->authorize('viewAny', View::class);
        $views = View::paginate(100);
        return new ViewCollection($views);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ViewStoreRequest $request)
    {
        $this->authorize('create', View::class);
        $validatedData = $request->validated();
        $view = View::create([
            'user_id' => Auth::id(),
            'content_id' => $validatedData['content_id'],
            'content_type' => $validatedData['content_type'],
            'view_date' => now(),
        ]);

        return ResponseMessages::success(['message' => 'View recorded successfully', 'view' => new ViewResource($view)], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(View $view)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, View $view)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(View $view)
    {
        $this->authorize('delete', $view);
        $view->delete();
        return ResponseMessages::success('View removed successfully', 204);
    }
}
