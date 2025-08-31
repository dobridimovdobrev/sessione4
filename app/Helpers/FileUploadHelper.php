<?php

namespace App\Helpers;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use App\Helpers\UploadProgressHelper;

class FileUploadHelper
{
    /**
     * Upload an image file and return the path
     *
     * @param UploadedFile $file
     * @param string $type Type of image (poster, backdrop, still, persons)
     * @param string|null $uploadId Optional upload ID for progress tracking
     * @return array
     */
    public static function uploadImage(UploadedFile $file, string $type, ?string $uploadId = null): array
    {
        // Generate a unique filename
        $filename = Str::uuid() . '.' . $file->getClientOriginalExtension();
        
        // Define the path based on the type
        $path = 'images/' . $type . '/' . $filename;
        
        // Initialize upload progress tracking if uploadId is not provided
        if (!$uploadId) {
            $uploadId = UploadProgressHelper::initializeUpload($file, 'image');
        }
        
        // Store the file
        $file->storeAs('public', $path);
        
        // Mark upload as completed
        UploadProgressHelper::completeUpload($uploadId);
        
        // Get file metadata
        $width = null;
        $height = null;
        
        // If it's an image, get dimensions
        if (in_array($file->getClientOriginalExtension(), ['jpg', 'jpeg', 'png', 'webp', 'gif'])) {
            try {
                list($width, $height) = getimagesize($file->getRealPath());
            } catch (\Exception $e) {
                // Unable to get image dimensions
            }
        }
        
        return [
            'url' => $path,
            'format' => $file->getClientOriginalExtension(),
            'size' => $file->getSize(),
            'width' => $width,
            'height' => $height,
            'base_path' => config('app.url') . '/storage/',
            'size_path' => 'original',
            'upload_id' => $uploadId,
        ];
    }
    
    /**
     * Upload a video file and return the path
     *
     * @param UploadedFile $file
     * @param string|null $uploadId Optional upload ID for progress tracking
     * @return array
     */
    public static function uploadVideo(UploadedFile $file, ?string $uploadId = null): array
    {
        // Generate a unique filename
        $filename = Str::uuid() . '.' . $file->getClientOriginalExtension();
        
        // Define the path
        $path = 'videos/' . $filename;
        
        // Initialize upload progress tracking if uploadId is not provided
        if (!$uploadId) {
            $uploadId = UploadProgressHelper::initializeUpload($file, 'video');
        }
        
        // Store the file
        $file->storeAs('public', $path);
        
        // Mark upload as completed
        UploadProgressHelper::completeUpload($uploadId);
        
        // Determine resolution (in a real app, you might want to use ffmpeg to get this)
        $resolution = '720p'; // Default value
        
        return [
            'url' => $path,
            'format' => $file->getClientOriginalExtension(),
            'size' => $file->getSize(),
            'resolution' => $resolution,
            'upload_id' => $uploadId
        ];
    }
    
    /**
     * Check if the file is a valid image
     *
     * @param UploadedFile $file
     * @return bool
     */
    public static function isValidImage(UploadedFile $file): bool
    {
        return in_array($file->getClientOriginalExtension(), [
            'jpg', 'jpeg', 'png', 'webp', 'gif'
        ]);
    }
    
    /**
     * Check if the file is a valid video
     *
     * @param UploadedFile $file
     * @return bool
     */
    public static function isValidVideo(UploadedFile $file): bool
    {
        return in_array($file->getClientOriginalExtension(), [
            'mp4', 'webm', 'ogg', 'mov', 'avi', 'mkv'
        ]);
    }
    
    /**
     * Generate a new upload ID for tracking progress
     *
     * @param UploadedFile $file
     * @param string $type Type of file (image, video, trailer)
     * @return string The upload ID
     */
    public static function generateUploadId(UploadedFile $file, string $type): string
    {
        return UploadProgressHelper::initializeUpload($file, $type);
    }
    
    /**
     * Get the current progress of an upload
     *
     * @param string $uploadId
     * @return array
     */
    public static function getUploadProgress(string $uploadId): array
    {
        return UploadProgressHelper::getProgress($uploadId);
    }
}
