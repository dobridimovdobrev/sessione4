<?php

namespace App\Http\Controllers\api\v1;

use App\Models\VideoFile;
use App\Helpers\ResponseMessages;
use App\Http\Controllers\Controller;
use App\Http\Requests\api\v1\VideoFileStoreRequest;
use App\Http\Requests\api\v1\VideoFileUpdateRequest;
use App\Http\Resources\api\v1\VideoFileResource;
use App\Http\Resources\api\v1\VideoFileCollection;

class VideoFileController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $this->authorize('viewAny', VideoFile::class);

        $videoFiles = VideoFile::paginate(10);
        return new VideoFileCollection($videoFiles);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(VideoFileStoreRequest $request)
    {
        $this->authorize('create', VideoFile::class);

        $validatedData = $request->validated();
        $videoFile = VideoFile::create($validatedData);

        return ResponseMessages::success(
            ['message' => 'VideoFile created successfully', 'videoFile' => new VideoFileResource($videoFile)], 
            201
        );
    }

    /**
     * Display the specified resource.
     */
    public function show(VideoFile $videoFile)
    {
        $this->authorize('view', $videoFile);

        return new VideoFileResource($videoFile);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(VideoFileUpdateRequest $request, VideoFile $videoFile)
    {
        $this->authorize('update', $videoFile);

        $validatedData = $request->validated();
        $videoFile->update($validatedData);

        return ResponseMessages::success(
            ['message' => 'VideoFile updated successfully', 'videoFile' => new VideoFileResource($videoFile)], 
            200
        );
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(VideoFile $videoFile)
    {
        $this->authorize('delete', $videoFile);

        $videoFile->delete();
        return ResponseMessages::success('VideoFile deleted successfully', 204);
    }
}
