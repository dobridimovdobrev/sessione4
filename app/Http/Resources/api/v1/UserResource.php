<?php

namespace App\Http\Resources\api\v1;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
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
            'username'=> $this->username,
            'first_name'=> $this->first_name,
            'last_name'=> $this->last_name,
            'email'=> $this->email,
            'gender'=> $this->gender,
            'birthday'=> $this->birthday,
            'country_id'=>$this->country_id,
            'user_status'=>$this->user_status,
            'role_id' => $this->role_id,
            'ip_address' => $this->ip_address ?? null,
            'last_activity' => $this->last_activity ?? null

        ];
    }
}
