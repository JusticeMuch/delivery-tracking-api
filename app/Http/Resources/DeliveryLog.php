<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class DeliveryLog extends JsonResource
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

    public static function formatReponse($log){
        return [
            "id" => $log->id,
            "status" => $log->status->name,
            "log" => $log->log
        ];
    }
}
