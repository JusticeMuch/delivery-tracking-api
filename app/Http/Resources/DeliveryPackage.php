<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class DeliveryPackage extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return self::formatReponse($this);
    }

    public static function formatReponse($package){
        return [
            "id" => $package->id,
            "package_name" => $package->package_name,
            "package_description" => $package->package_description,
            "weight" => $package->weight,
            "height" => $package->height,
            "length" => $package->length,
            "width" =>  $package->width,
        ];
    }
}
