<?php

namespace App\Http\Resources\api\v1;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class EpisodeResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'season_id' => $this->season_id,
            'episode_id' => $this->episode_id,
            'title' => $this->title,
            'description' => $this->description,
            'episode_number' => $this->episode_number,
            'duration' => $this->duration,
            'status' => $this->status,
            'still' => $this->imageFiles()->wherePivot('type', 'still')->first()?->url,
            'video_file' => VideoFileResource::collection($this->whenLoaded('videoFiles'))
        ];
    }
}
