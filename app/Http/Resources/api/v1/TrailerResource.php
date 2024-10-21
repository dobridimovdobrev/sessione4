<?php

namespace App\Http\Resources\api\v1;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TrailerResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'trailer_id' => $this->trailer_id,
            'title' => $this->title,
            'description' => $this->description,
            'url' => $this->url,
            'content_id' => $this->content_id,
            'content_type' => $this->content_type,
        ];
    }
}
