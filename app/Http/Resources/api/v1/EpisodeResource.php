<?php

namespace App\Http\Resources\api\v1;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class EpisodeResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        // Base data that is always present
        $data = [
            'season_id' => $this->season_id,
            'episode_id' => $this->episode_id,
            'title' => $this->title,
            'description' => $this->description,
            'episode_number' => $this->episode_number,
            'duration' => $this->duration,
            'air_date' => $this->air_date,
            'status' => $this->status,
            'still' => $this->getStillData()
        ];

        // Add details only when relationships are loaded (for single episode view)
        if ($this->resource->relationLoaded('videoFiles') && 
            $this->resource->relationLoaded('imageFiles')) {
            
            $data['video_files'] = $this->getVideoFilesData();
            
            // Include persons if loaded
            if ($this->resource->relationLoaded('persons')) {
                $data['persons'] = PersonResource::collection($this->whenLoaded('persons'));
            }
        }

        return $data;
    }

    /**
     * Get still image data with full URLs and multiple sizes for Angular
     *
     * @return array|null
     */
    private function getStillData()
    {
        $still = $this->imageFiles()->wherePivot('type', 'still')->first();
        
        if (!$still) {
            return null;
        }

        return [
            'url' => $still->full_url,
            'sizes' => [
                'w92' => $still->full_url,
                'w185' => $still->full_url,
                'w300' => $still->full_url,
                'original' => $still->full_url
            ],
            'width' => $still->width,
            'height' => $still->height,
            'format' => $still->format
        ];
    }

    /**
     * Get video files data with streaming URLs for Angular
     *
     * @return array
     */
    private function getVideoFilesData()
    {
        if (!$this->resource->relationLoaded('videoFiles')) {
            return [];
        }

        return $this->videoFiles->map(function($video) {
            return [
                'video_file_id' => $video->video_file_id,
                'title' => $video->title,
                'format' => $video->format,
                'resolution' => $video->resolution,
                'stream_url' => url('/api/v1/stream-video/' . basename($video->url)),
                'public_stream_url' => url('/api/v1/public-video/' . basename($video->url)),
                'type' => $this->getVideoFileType($video)
            ];
        })->toArray();
    }

    /**
     * Determine video file type based on format and URL
     *
     * @param object $video
     * @return string
     */
    private function getVideoFileType($video)
    {
        // Check if it's a YouTube URL
        if ($video->format === 'youtube' || 
            strpos($video->url, 'youtube.com') !== false || 
            strpos($video->url, 'youtu.be') !== false) {
            return 'youtube';
        }
        
        // Local video files (mp4, mkv, etc.) - episodes are typically local
        return 'local';
    }
}
