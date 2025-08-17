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
            'url' => $this->url,
            'format' => $this->format,
            'type' => $this->getVideoType(),
        ];
    }

    /**
     * Determine video type based on format and URL
     *
     * @return string
     */
    private function getVideoType()
    {
        // Check if it's a YouTube URL (TMDB trailers)
        if ($this->format === 'youtube' || 
            strpos($this->url, 'youtube.com') !== false || 
            strpos($this->url, 'youtu.be') !== false) {
            return 'youtube';
        }
        
        return 'local';
    }
}
