<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Delivery extends Model
{
    public function deliverySchedule(){
        return $this->hasOne(DeliverySchedule::class);
    }

    public function client(){
        return $this->hasOne(Client::class);
    }

    public function address(){
        return $this->hasOne(Address::class);
    }

    public function deliveryStatus(){
        return $this->hasOne(DeliveryStatus::class);
    }

    public function packages(){
        return $this->hasMany(DeliveryPackage::class);
    }

    public function logs(){
        return $this->hasMany(DeliveryLog::class);
    }

    public function updateStatus($status, $logMessage){
        $deliveryStatus = DeliveryStatus::where("status", $status)->first();
        if ($deliveryStatus){
            $this->delivery_status_id = $deliveryStatus->id;
            DeliveryLog::create([
                "delivery_id" => $this->id,
                "delivery_status_id" => $deliveryStatus->id,
                "log" => $logMessage
            ]);
        }
    }

    public static function createDeliveryFromRequest(array $requestData, int $clientId){
        $delivery = self::create([
            "client_id" => $clientId,
            "scheduled_date" => $requestData["scheduled_date"],
            "special_delivery_instructions" => $requestData["special_delivery_instructions"] ?? "",
            "tracking_code" => strtoupper(uniqid())
        ]);

        foreach($requestData["packages"] as $package){
            DeliveryPackage::create([
                "delivery_id" => $delivery->id,
                "package_name" => $package["package_name"],
                "package_description" => $package["package_description"] ?? "",
                "weight" => $package["weight"],
                "height" => $package["height"],
                "length" => $package["length"],
                "width" =>  $package["width"],
            ]);
        }

        $delivery->updateStatus("planned", "New delivery");

        return $delivery;
    }
}
