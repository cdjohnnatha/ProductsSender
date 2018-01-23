<?php

namespace App\Entities\Order;

use App\Entities\Client\ClientAddress;
use App\Entities\Entity;
use App\Entities\Package\Package;

class OrderFoward extends Entity
{
    protected $fillable = [
        'price',
        'client_address_id',
        'package_id',
        'goshippo_object_id',
        'order_id',
        'track_number',
    ];

    public function address()
    {
        return $this->belongsTo(ClientAddress::class, 'client_address_id', 'id');
    }

    public function package()
    {
        return $this->belongsTo(Package::class);
    }

    public function order()
    {
        return $this->belongsTo(Order::class);
    }
}
