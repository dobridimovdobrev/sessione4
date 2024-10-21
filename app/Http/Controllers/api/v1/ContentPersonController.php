<?php

namespace App\Http\Controllers\api\v1;

use Illuminate\Http\Request;
use App\Models\ContentPerson;
use App\Helpers\ResponseMessages;
use App\Http\Controllers\Controller;
use App\Http\Requests\api\v1\ContentPersonStoreRequest;
use App\Http\Requests\api\v1\ContentPersonUpdateRequest;
use App\Http\Resources\api\v1\ContentPersonResource;
use App\Http\Resources\api\v1\ContentPersonCollection;

class ContentPersonController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $this->authorize('viewAny', ContentPerson::class);

        $contentPersons = ContentPerson::paginate(100);
        return new ContentPersonCollection($contentPersons);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ContentPersonStoreRequest $request)
    {
        $this->authorize('create', ContentPerson::class);

        $validatedData = $request->validated();
        $contentPerson = ContentPerson::create($validatedData);

        return ResponseMessages::success(
            ['message' => 'ContentPerson created successfully', 'contentPerson' => new ContentPersonResource($contentPerson)], 
            201
        );
    }

    /**
     * Display the specified resource.
     */
    public function show(ContentPerson $contentPerson)
    {
         $this->authorize('view', $contentPerson);

        return new ContentPersonResource($contentPerson);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ContentPersonUpdateRequest $request, ContentPerson $contentPerson)
    {
         $this->authorize('update', $contentPerson);

        $validatedData = $request->validated();
        $contentPerson->update($validatedData);

        return ResponseMessages::success(
            ['message' => 'ContentPerson updated successfully', 'contentPerson' => new ContentPersonResource($contentPerson)], 
            200
        );
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ContentPerson $contentPerson)
    {
        $this->authorize('delete', $contentPerson);

        $contentPerson->delete();
        return ResponseMessages::success('ContentPerson deleted successfully', 204);
    }
}
