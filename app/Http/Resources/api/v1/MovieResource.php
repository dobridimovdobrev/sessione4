<?php

namespace App\Http\Resources\api\v1;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class MovieResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        // Base data that is always present (for list view)
        $data = [
            'movie_id' => $this->movie_id,
            'title' => $this->title,
            'year' => $this->year,
            'duration' => $this->duration,
            'imdb_rating' => $this->imdb_rating,
            'status' => $this->status,
            'category' => $this->category ? [
                'id' => $this->category->category_id,
                'name' => $this->category->name,
            ] : null,
            'poster' => $this->getPosterData()
        ];

        // Add details only for single movie view
        if ($this->resource->relationLoaded('persons') && 
            $this->resource->relationLoaded('trailers') && 
            $this->resource->relationLoaded('imageFiles') &&
            $this->resource->relationLoaded('videoFiles')) {
            
            $data['description'] = $this->description;
            $data['backdrop'] = $this->getBackdropData();
            $data['persons'] = PersonResource::collection($this->whenLoaded('persons'));
            $data['trailers'] = TrailerResource::collection($this->whenLoaded('trailers'));
            $data['video_files'] = $this->getVideoFilesData();
        }

        return $data;
    }

    /**
     * Get poster data with full URLs and multiple sizes for Angular
     *
     * @return array|null
     */
    private function getPosterData()
    {
        $poster = $this->imageFiles()->wherePivot('type', 'poster')->first();
        
        if (!$poster) {
            return null;
        }

        return [
            'url' => $poster->full_url,
            'sizes' => [
                'w92' => $poster->full_url, // For now, same URL - could be enhanced with actual resizing
                'w154' => $poster->full_url,
                'w185' => $poster->full_url,
                'w342' => $poster->full_url,
                'w500' => $poster->full_url,
                'w780' => $poster->full_url,
                'original' => $poster->full_url
            ],
            'width' => $poster->width,
            'height' => $poster->height,
            'format' => $poster->format
        ];
    }

    /**
     * Get backdrop data with full URLs and multiple sizes for Angular
     *
     * @return array|null
     */
    private function getBackdropData()
    {
        $backdrop = $this->imageFiles()->wherePivot('type', 'backdrop')->first();
        
        if (!$backdrop) {
            return null;
        }

        return [
            'url' => $backdrop->full_url,
            'sizes' => [
                'w300' => $backdrop->full_url,
                'w780' => $backdrop->full_url,
                'w1280' => $backdrop->full_url,
                'original' => $backdrop->full_url
            ],
            'width' => $backdrop->width,
            'height' => $backdrop->height,
            'format' => $backdrop->format
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
                'public_stream_url' => url('/api/v1/public-video/' . basename($video->url))
            ];
        })->toArray();
    }
}
