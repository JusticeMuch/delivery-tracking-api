<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    public function user(){
        return $this->hasOne(User::class);
    }

    public function addresses(){
        return $this->hasMany(Address::class);
    }

    public function deliveries(){
        return $this->hasMany(Delivery::class);
    }

    public function packages(){
        return $this->hasMany(DeliveryPackage::class);
    }
}
