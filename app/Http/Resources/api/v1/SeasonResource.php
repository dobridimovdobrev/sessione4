<?php

namespace App\Http\Resources\api\v1;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class SeasonResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $data = [
            'tv_series' => [
              'id' => $this->tv_series_id,
              'title' =>$this->tvSeries->title
            ],
            'season_id' => $this->season_id,
            'season_number' => $this->season_number,
            'total_episodes' => $this->total_episodes,
            'year' => $this->year,
            'poster' => $this->imageFiles()->where('type', 'poster')->first()?->url
        ];

        // Include episodes only when they are loaded
        if ($this->resource->relationLoaded('episodes')) {
            $data['episodes'] = $this->episodes->map(function($episode) {
                return [
                    'episode_id' => $episode->episode_id,
                    'title' => $episode->title,
                    'episode_number' => $episode->episode_number,
                    'description' => $episode->description,
                    'duration' => $episode->duration,
                    'still' => $episode->imageFiles->where('type', 'still')->first()?->url
                ];
            });
        }

        return $data;
    }
}
