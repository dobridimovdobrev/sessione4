<?php

namespace App\Helpers;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class FileUploadHelper
{
    /**
     * Upload an image file and return the path
     *
     * @param UploadedFile $file
     * @param string $type Type of image (poster, backdrop, still, persons)
     * @return array
     */
    public static function uploadImage(UploadedFile $file, string $type): array
    {
        // Generate a unique filename
        $filename = Str::uuid() . '.' . $file->getClientOriginalExtension();
        
        // Define the path based on the type
        $path = 'images/' . $type . '/' . $filename;
        
        // Store the file
        $file->storeAs('public', $path);
        
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
        ];
    }
    
    /**
     * Upload a video file and return the path
     *
     * @param UploadedFile $file
     * @return array
     */
    public static function uploadVideo(UploadedFile $file): array
    {
        // Generate a unique filename
        $filename = Str::uuid() . '.' . $file->getClientOriginalExtension();
        
        // Define the path
        $path = 'videos/' . $filename;
        
        // Store the file
        $file->storeAs('public', $path);
        
        // Determine resolution (in a real app, you might want to use ffmpeg to get this)
        $resolution = '720p'; // Default value
        
        return [
            'url' => $path,
            'format' => $file->getClientOriginalExtension(),
            'size' => $file->getSize(),
            'resolution' => $resolution
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
}
