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

        // Add details for single TV series view - check if seasons relation is loaded (indicates detail view)
        if ($this->resource->relationLoaded('seasons')) {
            
            $data['description'] = $this->description;
            $data['backdrop'] = $this->getBackdropData();
            $data['persons'] = PersonResource::collection($this->whenLoaded('persons'));
            $data['trailers'] = TrailerResource::collection($this->whenLoaded('trailers'));
            $data['video_files'] = $this->getVideoFilesData(); // Add TV series video files (trailers)
            
            // Add seasons and episodes for TV series - load them separately
            $data['seasons'] = $this->getSeasonsData();
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
                'w92' => $poster->full_url,
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
     * Get episode still data with full URLs and multiple sizes
     *
     * @param object $episode
     * @return array|null
     */
    private function getEpisodeStillData($episode)
    {
        // Always try to get still image, even if relation not loaded
        $still = $episode->imageFiles()->wherePivot('type', 'still')->first();
        
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
        // Always try to get video files, even if relation not loaded
        $videoFiles = $episode->videoFiles()->get();
        
        if ($videoFiles->isEmpty()) {
            return [];
        }

        return $videoFiles->map(function($video) {
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

    /**
     * Get TV series video files data (trailers) with streaming URLs
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
     * Get seasons data with episodes for TV series details
     *
     * @return array
     */
    private function getSeasonsData()
    {
        // Load seasons with episodes and their relationships
        $seasons = $this->seasons()
            ->with([
                'episodes.imageFiles',
                'episodes.videoFiles'
            ])
            ->orderBy('season_number')
            ->get();
        
        if ($seasons->isEmpty()) {
            return [];
        }

        return $seasons->map(function($season) {
            $episodesData = $season->episodes->map(function($episode) {
                return [
                    'episode_id' => $episode->episode_id,
                    'title' => $episode->title,
                    'description' => $episode->description,
                    'episode_number' => $episode->episode_number,
                    'duration' => $episode->duration,
                    'air_date' => $episode->air_date,
                    'status' => $episode->status,
                    'still' => $this->getEpisodeStillData($episode),
                    'video_files' => $this->getEpisodeVideoFilesData($episode)
                ];
            })->toArray();

            return [
                'season_id' => $season->season_id,
                'season_number' => $season->season_number,
                'name' => $season->name,
                'overview' => $season->overview,
                'total_episodes' => $season->total_episodes,
                'year' => $season->year,
                'premiere_date' => $season->premiere_date,
                'episodes' => $episodesData
            ];
        })->toArray();
    }
}
