<?php

namespace App\Entities\Order;

use App\Entities\Client\ClientAddress;
use App\Entities\Entity;

class OrderFoward extends Entity
{
    protected $fillable = [
        'price',
        'client_address_id',
        'package_id',
        'goshippo_rate_id',
        'order_id',
        'track_number',
    ];

    public function address()
    {
        return $this->belongsTo(ClientAddress::class, 'client_address_id', 'id');
    }
}
