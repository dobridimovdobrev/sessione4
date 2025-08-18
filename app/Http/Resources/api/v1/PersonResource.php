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
        $profileImage = $this->imageFiles()->wherePivot('type', 'persons')->first();
        
        return [
            'person_id' => $this->person_id,
            'name' => $this->name,
            'profile_image' => $profileImage?->url,
            'profile_image_full' => $profileImage ? 'https://api.dobridobrev.com/storage/' . $profileImage->url : null,
            'image_id' => $profileImage?->image_id
        ];
    }
}
