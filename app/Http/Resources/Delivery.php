<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class Delivery extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $results =  [
            "id" => $this->id,
            "client_id" => $this->client_id,
            "scheduled_date" => $this->scheduled_date,
            "special_delivery_instructions" => $this->special_delivery_instructions,
            "tracking_code" => $this->tracking_code,
            "packages" => [],
            "logs" => [],
        ];

        foreach ($this->package as $package){
            $results["packages"][] = DeliveryPackage::formatReponse($package);
        }

        return $results;
    }
}
