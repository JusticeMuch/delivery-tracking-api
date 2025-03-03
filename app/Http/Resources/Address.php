<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class Address extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            "id" => $this->id,
            "street_address_1" => $this->street_address_1,
            "street_address_2" => $this->street_address_2,
            "suburb" => $this->suburb,
            "post_code" => $this->post_code,
            "city" => $this->city,
            "province" => $this->province,
            "country" => $this->country
        ];

    }
}
