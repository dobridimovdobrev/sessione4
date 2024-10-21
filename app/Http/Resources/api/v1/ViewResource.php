<?php

namespace App\Http\Resources\api\v1;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ViewResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'user_id' => $this->user_id,
            'view_id' => $this->view_id,
            'content_id' => $this->content_id,
            'content_type' => $this->content_type,
            'view_date' => $this->view_date,
        ];
    }
}
