<?php

namespace App\Http\Controllers\api\v1;

use App\Models\Trailer;
use App\Helpers\ResponseMessages;
use App\Http\Controllers\Controller;
use App\Http\Requests\api\v1\TrailerStoreRequest;
use App\Http\Requests\api\v1\TrailerUpdateRequest;
use App\Http\Resources\api\v1\TrailerResource;
use App\Http\Resources\api\v1\TrailerCollection;
use Illuminate\Http\Request;

class TrailerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $this->authorize('viewAny', Trailer::class);

        // Apply filters if any
        $filterData = $request->all();
        $query = Trailer::query();
        // Filter movies by different parameters/keys
        foreach ($filterData as $key => $value) {
            if (in_array($key, ['trailer_id', 'title'])) {
                $query->where($key, 'LIKE', "%$value%");
            }
        }

        $trailers = $query->paginate(50);
        return new TrailerCollection($trailers);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(TrailerStoreRequest $request)
    {
        $this->authorize('create', Trailer::class);

        $validatedData = $request->validated();
        $trailer = Trailer::create($validatedData);

        return ResponseMessages::success(
            ['message' => 'Trailer created successfully', 'trailer' => new TrailerResource($trailer)], 
            201
        );
    }

    /**
     * Display the specified resource.
     */
    public function show(Trailer $trailer)
    {
         $this->authorize('view', $trailer);

        return new TrailerResource($trailer);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(TrailerUpdateRequest $request, Trailer $trailer)
    {
         $this->authorize('update', $trailer);

        $validatedData = $request->validated();
        $trailer->update($validatedData);

        return ResponseMessages::success(
            ['message' => 'Trailer updated successfully', 'trailer' => new TrailerResource($trailer)], 
            200
        );
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Trailer $trailer)
    {
        $this->authorize('delete', $trailer);

        $trailer->delete();
        return ResponseMessages::success('Trailer deleted successfully', 204);
    }
}
