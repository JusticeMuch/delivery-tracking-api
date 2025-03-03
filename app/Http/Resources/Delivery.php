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
        return self::formatResponse($this);
    }

    public static function formatResponse($delivery){
        $results =  [
            "id" => $delivery->id,
            "client_id" => $delivery->client_id,
            "scheduled_date" => $delivery->scheduled_date,
            "special_delivery_instructions" => $delivery->special_delivery_instructions,
            "tracking_code" => $delivery->tracking_code,
            "packages" => [],
            "logs" => [],
        ];

        foreach ($delivery->package as $package){
            $results["packages"][] = DeliveryPackage::formatReponse($package);
        }

        foreach ($delivery->logs as $log){
            $results["logs"][] = DeliveryLog::formatReponse($package);
        }

        return $results;
    }
}
