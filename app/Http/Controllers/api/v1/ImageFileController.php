<?php

namespace App\Http\Controllers\api\v1;

use App\Models\ImageFile;
use App\Helpers\ResponseMessages;
use App\Http\Controllers\Controller;
use App\Http\Requests\api\v1\ImageFileStoreRequest;
use App\Http\Requests\api\v1\ImageFileUpdateRequest;
use App\Http\Resources\api\v1\ImageFileResource;
use App\Http\Resources\api\v1\ImageFileCollection;

class ImageFileController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $this->authorize('viewAny', ImageFile::class);

        $imageFiles = ImageFile::paginate(10);
        return new ImageFileCollection($imageFiles);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ImageFileStoreRequest $request)
    {
        $this->authorize('create', ImageFile::class);

        $validatedData = $request->validated();
        $imageFile = ImageFile::create($validatedData);

        return ResponseMessages::success(
            ['message' => 'ImageFile created successfully', 'imageFile' => new ImageFileResource($imageFile)], 
            201
        );
    }

    /**
     * Display the specified resource.
     */
    public function show(ImageFile $imageFile)
    {
        $this->authorize('view', $imageFile);

        return new ImageFileResource($imageFile);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ImageFileUpdateRequest $request, ImageFile $imageFile)
    {
         $this->authorize('update', $imageFile);

        $validatedData = $request->validated();
        $imageFile->update($validatedData);

        return ResponseMessages::success(
            ['message' => 'ImageFile updated successfully', 'imageFile' => new ImageFileResource($imageFile)], 
            200
        );
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ImageFile $imageFile)
    {
        $this->authorize('delete', $imageFile);

        $imageFile->delete();
        return ResponseMessages::success('ImageFile deleted successfully', 204);
    }
}
