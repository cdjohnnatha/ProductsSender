<?php

namespace App\Entities\Order;

use App\Entities\Entity;

class OrderFoward extends Entity
{
    protected $fillable = [
        'price',
        'client_address_id',
        'package_id',
        'goshippo_shipment',
        'order_id',
        'track_number',
    ];
}
