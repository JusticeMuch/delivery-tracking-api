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
}
