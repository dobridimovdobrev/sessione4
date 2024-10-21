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
        return [
            'tv_series_id' => $this->tv_series_id,
            'season_id' => $this->season_id,
            'season_number' => $this->season_number,
            'total_episodes' => $this->total_episodes,
            'year' => $this->year,
        ];
    }
}
