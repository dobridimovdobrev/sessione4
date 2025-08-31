<?php

namespace App\Helpers;

use App\Models\UploadProgress;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;

class UploadProgressHelper
{
    /**
     * Initialize a new upload progress tracking
     *
     * @param UploadedFile $file
     * @param string $fileType Type of file (image, video, trailer)
     * @return string The upload ID
     */
    public static function initializeUpload(UploadedFile $file, string $fileType): string
    {
        $uploadId = Str::uuid()->toString();
        
        // Create a new upload progress record
        $progress = new UploadProgress([
            'upload_id' => $uploadId,
            'file_name' => $file->getClientOriginalName(),
            'file_size' => $file->getSize(),
            'uploaded_size' => 0,
            'progress_percentage' => 0,
            'status' => 'pending',
            'user_id' => Auth::id(),
            'file_type' => $fileType,
        ]);
        
        $progress->save();
        
        // Store the upload ID in cache for quick access
        Cache::put('upload_progress_' . $uploadId, [
            'id' => $progress->id,
            'status' => 'pending',
            'progress' => 0
        ], now()->addHours(1));
        
        return $uploadId;
    }
    
    /**
     * Update the progress of an upload
     *
     * @param string $uploadId
     * @param int $uploadedSize
     * @return array
     */
    public static function updateProgress(string $uploadId, int $uploadedSize): array
    {
        $progress = UploadProgress::where('upload_id', $uploadId)->first();
        
        if (!$progress) {
            return [
                'success' => false,
                'message' => 'Upload not found'
            ];
        }
        
        $progress->updateProgress($uploadedSize);
        
        // Update cache
        Cache::put('upload_progress_' . $uploadId, [
            'id' => $progress->id,
            'status' => $progress->status,
            'progress' => $progress->progress_percentage
        ], now()->addHours(1));
        
        return [
            'success' => true,
            'progress' => $progress->progress_percentage,
            'status' => $progress->status
        ];
    }
    
    /**
     * Mark an upload as completed
     *
     * @param string $uploadId
     * @return array
     */
    public static function completeUpload(string $uploadId): array
    {
        $progress = UploadProgress::where('upload_id', $uploadId)->first();
        
        if (!$progress) {
            return [
                'success' => false,
                'message' => 'Upload not found'
            ];
        }
        
        $progress->markAsCompleted();
        
        // Update cache
        Cache::put('upload_progress_' . $uploadId, [
            'id' => $progress->id,
            'status' => 'completed',
            'progress' => 100
        ], now()->addHours(1));
        
        return [
            'success' => true,
            'progress' => 100,
            'status' => 'completed'
        ];
    }
    
    /**
     * Mark an upload as failed
     *
     * @param string $uploadId
     * @param string|null $errorMessage
     * @return array
     */
    public static function failUpload(string $uploadId, ?string $errorMessage = null): array
    {
        $progress = UploadProgress::where('upload_id', $uploadId)->first();
        
        if (!$progress) {
            return [
                'success' => false,
                'message' => 'Upload not found'
            ];
        }
        
        $progress->markAsFailed($errorMessage);
        
        // Update cache
        Cache::put('upload_progress_' . $uploadId, [
            'id' => $progress->id,
            'status' => 'failed',
            'progress' => $progress->progress_percentage,
            'error' => $errorMessage
        ], now()->addHours(1));
        
        return [
            'success' => true,
            'progress' => $progress->progress_percentage,
            'status' => 'failed',
            'error' => $errorMessage
        ];
    }
    
    /**
     * Get the current progress of an upload
     *
     * @param string $uploadId
     * @return array
     */
    public static function getProgress(string $uploadId): array
    {
        // Try to get from cache first for better performance
        $cachedProgress = Cache::get('upload_progress_' . $uploadId);
        
        if ($cachedProgress) {
            return [
                'success' => true,
                'progress' => $cachedProgress['progress'],
                'status' => $cachedProgress['status'],
                'error' => $cachedProgress['error'] ?? null
            ];
        }
        
        // If not in cache, get from database
        $progress = UploadProgress::where('upload_id', $uploadId)->first();
        
        if (!$progress) {
            return [
                'success' => false,
                'message' => 'Upload not found'
            ];
        }
        
        // Update cache for next time
        Cache::put('upload_progress_' . $uploadId, [
            'id' => $progress->id,
            'status' => $progress->status,
            'progress' => $progress->progress_percentage,
            'error' => $progress->error_message
        ], now()->addHours(1));
        
        return [
            'success' => true,
            'progress' => $progress->progress_percentage,
            'status' => $progress->status,
            'error' => $progress->error_message
        ];
    }
    
    /**
     * Clean up old upload progress records
     *
     * @param int $hours Hours to keep records
     * @return int Number of records deleted
     */
    public static function cleanupOldRecords(int $hours = 24): int
    {
        return UploadProgress::where('created_at', '<', now()->subHours($hours))->delete();
    }
}
