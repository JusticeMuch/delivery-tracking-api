<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DeliveryPackages extends Model
{
    public function delivery(){
        return $this->hasOne(Delivery::class);
    }

    public function status(){
        return $this->hasOne(DeliveryStatus::class);
    }
}
