<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DeliverySchedule extends Model
{
    public function driver(){
        return $this->hasOne(Driver::class);
    }

    public function deliveryRegion(){
        return $this->hasOne(DeliveryRegion::class);
    }
}
