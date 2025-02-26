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
}
