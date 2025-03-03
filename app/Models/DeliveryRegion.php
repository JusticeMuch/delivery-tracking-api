<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DeliveryRegion extends Model
{
    protected $casts = [
        'field_name' => 'array'
    ];

    public static function getDeliveryRegionFromProvinceAndSuburb(string $province, string $suburb)
    {
        $query = self::query()->where("province", "=", $province)->where("suburb", "LIKE", "%$suburb%");
        return $query->get();
    }
}
