<?php

namespace App\Http\Resources\api\v1;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TvSeriesResource extends JsonResource
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
            'tv_series_id' => $this->tv_series_id,
            'title' => $this->title,
            'year' => $this->year,
            'imdb_rating' => $this->imdb_rating,
            'total_seasons' => $this->total_seasons,
            'total_episodes' => $this->total_episodes,
            'status' => $this->status,
            'category' => $this->category ? [
                'id' => $this->category->category_id,
                'name' => $this->category->name,
            ] : null,
            'poster' => $this->getPosterData()
        ];

        // Add details only for single TV series view
        if ($this->resource->relationLoaded('persons') && 
            $this->resource->relationLoaded('trailers') && 
            $this->resource->relationLoaded('imageFiles') &&
            $this->resource->relationLoaded('videoFiles')) {
            
            $data['description'] = $this->description;
            $data['backdrop'] = $this->getBackdropData();
            $data['persons'] = PersonResource::collection($this->whenLoaded('persons'));
            $data['trailers'] = TrailerResource::collection($this->whenLoaded('trailers'));
            $data['video_files'] = $this->getVideoFilesData();
            
            // Include seasons with episodes when loaded
            if ($this->resource->relationLoaded('seasons')) {
                $data['seasons'] = $this->seasons->map(function($season) {
                    return [
                        'season_id' => $season->season_id,
                        'season_number' => $season->season_number,
                        'year' => $season->year,
                        'total_episodes' => $season->total_episodes,
                        'episodes' => $season->episodes->map(function($episode) {
                            return [
                                'episode_id' => $episode->episode_id,
                                'title' => $episode->title,
                                'episode_number' => $episode->episode_number,
                                'duration' => $episode->duration,
                                'air_date' => $episode->air_date,
                                'still' => $this->getEpisodeStillData($episode),
                                'video_files' => $this->getEpisodeVideoFilesData($episode)
                            ];
                        })
                    ];
                });
            }
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
        // Check if imageFiles relation is loaded, if not return null
        if (!$this->resource->relationLoaded('imageFiles')) {
            return null;
        }
        
        // Use loaded relation instead of new query
        $poster = $this->imageFiles->where('pivot.type', 'poster')->first();
        
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
        // Check if imageFiles relation is loaded, if not return null
        if (!$this->resource->relationLoaded('imageFiles')) {
            return null;
        }
        
        // Use loaded relation instead of new query
        $backdrop = $this->imageFiles->where('pivot.type', 'backdrop')->first();
        
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
     * Get video files data with streaming URLs for Angular (TV series trailers)
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
     * Get episode still data with full URLs and multiple sizes
     *
     * @param object $episode
     * @return array|null
     */
    private function getEpisodeStillData($episode)
    {
        // Check if imageFiles relation is loaded for episode
        if (!$episode->relationLoaded('imageFiles')) {
            return null;
        }
        
        // Use loaded relation instead of new query
        $still = $episode->imageFiles->where('pivot.type', 'still')->first();
        
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
     * Get episode video files data with streaming URLs
     *
     * @param object $episode
     * @return array
     */
    private function getEpisodeVideoFilesData($episode)
    {
        if (!$episode->relationLoaded('videoFiles')) {
            return [];
        }

        return $episode->videoFiles->map(function($video) {
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
        
        // Local video files (mp4, mkv, etc.)
        return 'local';
    }
}
