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
        // Base data that is always present
        $data = [
            'tv_series_id' => $this->tv_series_id,
            'title' => $this->title,
            'year' => $this->year,
            'imdb_rating' => $this->imdb_rating,
            'total_seasons' => $this->total_seasons,
            'status' => $this->status,
            'category' => [
                'id' => $this->category_id,
                'name' => $this->category->name, 
            ],
            'poster' => $this->imageFiles()->where('type', 'poster')->first()?->url,
        ];

        // Add details only when relationships are loaded (for single tv series view)
        if ($this->resource->relationLoaded('persons') || 
            $this->resource->relationLoaded('trailers') || 
            $this->resource->relationLoaded('imageFiles')) {
            
            $data['description'] = $this->description;
            $data['backdrop'] = $this->imageFiles()->where('type', 'backdrop')->first()?->url;
            $data['persons'] = PersonResource::collection($this->whenLoaded('persons'));
            $data['trailers'] = TrailerResource::collection($this->whenLoaded('trailers'));
            $data['images'] = ImageFileResource::collection($this->whenLoaded('imageFiles'));
            
            // Include seasons with episodes when loaded
            if ($this->resource->relationLoaded('seasons')) {
                $data['seasons'] = $this->seasons->map(function($season) {
                    return [
                        'season_id' => $season->season_id,
                        'season_number' => $season->season_number,
                        'year' => $season->year,
                        'total_episodes' => $season->total_episodes,
                        'poster' => $season->imageFiles()->where('type', 'poster')->first()?->url,
                        'episodes' => $season->episodes->map(function($episode) {
                            return [
                                'episode_id' => $episode->episode_id,
                                'title' => $episode->title,
                                'episode_number' => $episode->episode_number,
                                'still' => $episode->imageFiles()->where('type', 'still')->first()?->url,
                            ];
                        })
                    ];
                });
            }
        }

        return $data;
    }
}
