<?php

namespace App\Http\Resources\api\v1;

use Illuminate\Http\Resources\Json\JsonResource;

class CountryResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray( $request)
    {
        return [
            'country_id' => $this->country_id,
            'name' => $this->name,
            'continent' => $this->continent,
            'iso_char2' => $this->iso_char2,  // Make sure these match your DB column names
            'iso_char3' => $this->iso_char3,
            'phone_prefix' => $this->phone_prefix
        ];
    }

   
}
