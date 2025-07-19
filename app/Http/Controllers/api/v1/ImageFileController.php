<?php

namespace App\Http\Controllers\api\v1;

use App\Models\ImageFile;
use Illuminate\Http\Request;
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
    public function index(Request $request)
    {
        $this->authorize('viewAny', ImageFile::class);

        $filterData = $request->all();
        $query = ImageFile::query();

        foreach($filterData as $key=>$value){
            if(in_array($key,['image_id', 'url', 'title'])){
                $query = $query->where($key, 'LIKE', "%$value%");
            }
        }

        $imageFiles = $query->paginate(50);
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
    public function show(ImageFile $image)
    {
        $this->authorize('view', $image);

        return new ImageFileResource($image);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ImageFileUpdateRequest $request, ImageFile $image)
    {
         $this->authorize('update', $image);

        $validatedData = $request->validated();
        $image->update($validatedData);

        return ResponseMessages::success(
            ['message' => 'ImageFile updated successfully', 'imageFile' => new ImageFileResource($image)], 
            200
        );
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ImageFile $image)
    {
        $this->authorize('delete', $image);

        $image->delete();
        return ResponseMessages::success('ImageFile deleted successfully', 204);
    }
}
