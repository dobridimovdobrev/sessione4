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
        // Base data that is always present
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
            'poster' => $this->imageFiles()->where('type', 'poster')->first()?->url,
        ];

        // Add details only when relationships are loaded (for single movie view)
        if ($this->resource->relationLoaded('persons') || 
            $this->resource->relationLoaded('trailers') || 
            $this->resource->relationLoaded('imageFiles')) {
            
            $data['description'] = $this->description;
            $data['backdrop'] = $this->imageFiles()->where('type', 'backdrop')->first()?->url;
            $data['persons'] = PersonResource::collection($this->whenLoaded('persons'));
            $data['trailers'] = TrailerResource::collection($this->whenLoaded('trailers'));
            $data['images'] = ImageFileResource::collection($this->whenLoaded('imageFiles'));
        }

        return $data;
    }
}
