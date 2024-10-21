<?php

namespace App\Http\Resources\api\v1;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ImageFileResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'image_id' => $this->image_id,
            'url' => $this->url,
            'title' => $this->title,
            'description' => $this->description,
            'content_id' => $this->content_id,
            'content_type' => $this->content_type,
            'format' => $this->format,
            'size' => $this->size,
            'width' => $this->width,
            'height' => $this->height,
        ];
    }
}
