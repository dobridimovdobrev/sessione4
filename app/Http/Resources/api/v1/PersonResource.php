<?php

namespace App\Http\Resources\api\v1;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PersonResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
          return [
            'person_id' => $this->person_id,
            'name' => $this->name,
            'profile_image' => $this->imageFiles()->wherePivot('type', 'persons')->first()?->url
        ];
    }
}
