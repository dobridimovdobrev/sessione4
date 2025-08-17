<?php

namespace App\Http\Controllers\api\v1;

use App\Models\ImageFile;
use App\Models\VideoFile;
use App\Models\Trailer;
use Illuminate\Http\Request;
use App\Helpers\ResponseMessages;
use App\Helpers\FileUploadHelper;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use App\Http\Resources\api\v1\ImageFileResource;
use App\Http\Resources\api\v1\VideoFileResource;
use App\Http\Resources\api\v1\TrailerResource;

class FileUploadController extends Controller
{
    /**
     * Upload image file for frontend Angular
     * Supports multiple image types: poster, backdrop, still, persons
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function uploadImage(Request $request)
    {
        // Authorization check
        $this->authorize('create', ImageFile::class);

        // Validation
        $validator = Validator::make($request->all(), [
            'image' => 'required|file|mimes:jpg,jpeg,png,webp,gif|max:10240', // Max 10MB
            'type' => 'required|string|in:poster,backdrop,still,persons',
            'title' => 'nullable|string|max:255',
            'description' => 'nullable|string|max:1000',
        ]);

        if ($validator->fails()) {
            return ResponseMessages::error([
                'message' => 'Validation failed',
                'errors' => $validator->errors()
            ], 422);
        }

        try {
            $file = $request->file('image');
            $type = $request->input('type');
            
            // Upload file using helper
            $fileData = FileUploadHelper::uploadImage($file, $type);
            
            // Create image record
            $imageFile = ImageFile::create([
                'url' => $fileData['url'],
                'title' => $request->input('title', $file->getClientOriginalName()),
                'description' => $request->input('description', 'Uploaded via API'),
                'type' => $type,
                'format' => $fileData['format'],
                'size' => $fileData['size'],
                'width' => $fileData['width'],
                'height' => $fileData['height'],
                'base_path' => $fileData['base_path'],
                'size_path' => $fileData['size_path'],
            ]);

            return ResponseMessages::success([
                'message' => 'Image uploaded successfully',
                'image' => new ImageFileResource($imageFile),
                'full_url' => $imageFile->full_url, // Direct URL for Angular
                'available_sizes' => $this->getAvailableSizes($type)
            ], 201);

        } catch (\Exception $e) {
            return ResponseMessages::error([
                'message' => 'Upload failed',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Upload video file for frontend Angular
     * Supports multiple video formats
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function uploadVideo(Request $request)
    {
        // Authorization check
        $this->authorize('create', VideoFile::class);

        // Validation
        $validator = Validator::make($request->all(), [
            'video' => 'required|file|mimes:mp4,webm,ogg,mov,avi,mkv|max:512000', // Max 500MB
            'title' => 'nullable|string|max:255',
        ]);

        if ($validator->fails()) {
            return ResponseMessages::error([
                'message' => 'Validation failed',
                'errors' => $validator->errors()
            ], 422);
        }

        try {
            $file = $request->file('video');
            
            // Upload file using helper
            $fileData = FileUploadHelper::uploadVideo($file);
            
            // Create video record
            $videoFile = VideoFile::create([
                'url' => $fileData['url'],
                'title' => $request->input('title', $file->getClientOriginalName()),
                'format' => $fileData['format'],
                'resolution' => $fileData['resolution'],
            ]);

            return ResponseMessages::success([
                'message' => 'Video uploaded successfully',
                'video' => new VideoFileResource($videoFile),
                'stream_url' => url('/api/v1/stream-video/' . basename($fileData['url'])), // Direct streaming URL for Angular
                'public_stream_url' => url('/api/v1/public-video/' . basename($fileData['url'])) // Public streaming URL
            ], 201);

        } catch (\Exception $e) {
            return ResponseMessages::error([
                'message' => 'Upload failed',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Get upload progress (for large files)
     * Useful for Angular progress bars
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function getUploadProgress(Request $request)
    {
        $uploadId = $request->input('upload_id');
        
        // This would require additional implementation for real progress tracking
        // For now, return a basic response
        return ResponseMessages::success([
            'upload_id' => $uploadId,
            'progress' => 100, // Placeholder
            'status' => 'completed'
        ], 200);
    }

    /**
     * Get available image sizes for a specific type
     * Helper method for Angular frontend
     *
     * @param string $type
     * @return array
     */
    private function getAvailableSizes($type)
    {
        $sizeMaps = [
            'poster' => ['w92', 'w154', 'w185', 'w342', 'w500', 'w780', 'original'],
            'backdrop' => ['w300', 'w780', 'w1280', 'original'],
            'persons' => ['w45', 'w185', 'h632', 'original'],
            'still' => ['w92', 'w185', 'w300', 'original']
        ];

        return $sizeMaps[$type] ?? ['original'];
    }

    /**
     * Upload trailer file for frontend Angular
     * Saves to trailers table instead of video_files
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function uploadTrailer(Request $request)
    {
        // Authorization check
        $this->authorize('create', Trailer::class);

        // Validation
        $validator = Validator::make($request->all(), [
            'video' => 'required|file|mimes:mp4,webm,ogg,mov,avi,mkv|max:512000', // Max 500MB
            'title' => 'nullable|string|max:255',
            'description' => 'nullable|string|max:1000',
        ]);

        if ($validator->fails()) {
            return ResponseMessages::error([
                'message' => 'Validation failed',
                'errors' => $validator->errors()
            ], 422);
        }

        try {
            $file = $request->file('video');
            
            // Upload file using helper
            $fileData = FileUploadHelper::uploadVideo($file);
            
            // Create trailer record in trailers table
            $trailer = Trailer::create([
                'url' => $fileData['url'],
                'title' => $request->input('title', $file->getClientOriginalName()),
                'description' => $request->input('description', 'Uploaded trailer'),
                'format' => $fileData['format'] ?? 'mp4',
            ]);

            return ResponseMessages::success([
                'message' => 'Trailer uploaded successfully',
                'trailer' => new TrailerResource($trailer),
                'trailer_id' => $trailer->trailer_id,
                'stream_url' => url('/api/v1/stream-video/' . basename($fileData['url'])),
                'public_stream_url' => url('/api/v1/public-video/' . basename($fileData['url'])),
                'type' => 'local' // Always local for uploaded trailers
            ], 201);

        } catch (\Exception $e) {
            return ResponseMessages::error([
                'message' => 'Trailer upload failed',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Get supported file formats
     * Helper endpoint for Angular frontend
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function getSupportedFormats()
    {
        return ResponseMessages::success([
            'image_formats' => ['jpg', 'jpeg', 'png', 'webp', 'gif'],
            'video_formats' => ['mp4', 'webm', 'ogg', 'mov', 'avi', 'mkv'],
            'max_sizes' => [
                'image' => '10MB',
                'video' => '500MB'
            ],
            'image_types' => ['poster', 'backdrop', 'still', 'persons']
        ], 200);
    }
}
