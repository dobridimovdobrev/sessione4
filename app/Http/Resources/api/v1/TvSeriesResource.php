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
        return [
            'tv_series_id' => $this->tv_series_id,
            'title' => $this->title,
            'description' => $this->description,
            'year' => $this->year,
            'imdb_rating' => $this->imdb_rating,
            'total_seasons' => $this->total_seasons,
            'status' => $this->status,
            'category' => [
                'id' => $this->category_id,
                'name' => $this->category->name, 
            ],

            // Persons, Trailers, image files
            'persons' => PersonResource::collection($this->whenLoaded('persons')),
            'trailers' => TrailerResource::collection($this->whenLoaded('trailers')),
            'image_files' => ImageFileResource::collection($this->whenLoaded('imageFiles')),
        ];
    }
}
