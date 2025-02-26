<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Driver extends Model
{
    public function user(){
        return $this->hasOne(User::class);
    }

    public function deliveryRegion(){
        return $this->hasOne(DeliveryRegion::class);
    }
}
