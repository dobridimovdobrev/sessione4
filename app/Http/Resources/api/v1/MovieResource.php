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
        
        return [
            "movie_id" => $this->movie_id,
            "category_id" => $this->category_id,
            "title" => $this->title,
            "description" => $this->description,
            "year" => $this->year,
            "duration" => $this->duration,
            "imdb_rating" => $this->imdb_rating,
            "status" => $this->status
        ];
    }
}
