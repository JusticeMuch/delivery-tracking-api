<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    /**
     *Client relationship
     */
    public function client()
    {
        return $this->belongsTo(Client::class);
    }

    public function deliveryRegion(){
        return $this->hasOne(DeliveryRegion::class);
    }

    public function updateDeliveryRegion(){
        $regions = DeliveryRegion::getDeliveryRegionFromProvinceAndSuburb($this->province, $this->suburb);
        if (!empty($regions)){
            $this->delivery_region_id = $regions[0]["id"];
            $this->save();
        }
    }

    public static function getSuburbsWithoutDeliveryRegions(){
        $query = self::query()->whereNull("delivery_region_id");
        return $query->get()->pluck("suburb");
    }

    public static function getAddressesWhereDeliveryRegionIsNull(){
        return self::whereNull("delivery_region_id");
    }

    public static function updateEmptyDeliveryRegions(){
        foreach (self::getAddressesWhereDeliveryRegionIsNull() as $address) {
            $address->updateDeliveryRegion();
        }
    }
}
