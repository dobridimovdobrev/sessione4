<?php

namespace App\Http\Resources\api\v1;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ContentPersonResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'content_persons_id' => $this->content_persons_id,
            'content_id' => $this->content_id,
            'content_type' => $this->content_type,
            'person_id' => $this->person_id,
        ];
    }
}
