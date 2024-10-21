<?php

namespace App\Http\Resources\api\v1;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class VideoFileResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'video_file_id' => $this->video_file_id,
            'title' => $this->title,
            'description' => $this->description,
            'url' => $this->url,
            'content_id' => $this->content_id,
            'content_type' => $this->content_type,
            'format' => $this->format,
            'size' => $this->size,
            'resolution' => $this->resolution,
            'duration' => $this->duration,
        ];
    }
}
