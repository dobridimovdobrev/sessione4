<?php

namespace App\Http\Controllers\api\v1;

use App\Models\VideoFile;
use Illuminate\Http\Request;
use App\Helpers\ResponseMessages;
use App\Helpers\FileUploadHelper;
use App\Http\Controllers\Controller;
use App\Http\Resources\api\v1\VideoFileResource;
use App\Http\Resources\api\v1\VideoFileCollection;
use App\Http\Requests\api\v1\VideoFileStoreRequest;
use App\Http\Requests\api\v1\VideoFileUpdateRequest;

class VideoFileController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $this->authorize('viewAny', VideoFile::class);

        // Apply filters if any
        $filterData = $request->all();
        $query = VideoFile::query();
 // Filter movies by different parameters/keys
        foreach ($filterData as $key => $value) {
            if (in_array($key, ['video_file_id', 'title'])) {
                $query->where($key, 'LIKE', "%$value%");
            }
        }

        $videoFiles = $query->paginate(50);
        return new VideoFileCollection($videoFiles);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(VideoFileStoreRequest $request)
    {
        $this->authorize('create', VideoFile::class);

        $validatedData = $request->validated();
        
        // Check if we're uploading a file
        if ($request->hasFile('video')) {
            $file = $request->file('video');
            
            // Use the helper to upload and get file metadata
            $fileData = FileUploadHelper::uploadVideo($file);
            
            // Merge the file data with the validated data
            $validatedData = array_merge($validatedData, $fileData);
        }
        
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
