<?php

namespace App\Http\Resources\api\v1;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CreditResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'credit_id' => $this->credit_id,
            'user_id' => $this->user_id,
            'total_credits' => $this->total_credits,
            'spent_credits' => $this->spent_credits,
            'remaining_credits' => $this->remaining_credits,
        ];
    }
}
