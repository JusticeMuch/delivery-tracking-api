<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class DeliverySchedule extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $results = [
            "id" => $this->id,
            "delivery_date" => $this->delivery_date,
            "amount_of_deliveries" => $this->amount_of_deliveries,
            "deliveries_completed" => $this->deliveries_completed,
            "completed" => $this->delivery_completed,
            "deliveries" => []
        ];

        foreach ($this->deliveries as $delivery){
            $results["deliveries"][] = Delivery::formatResponse($delivery);
        }

        return $results;
    }
}
