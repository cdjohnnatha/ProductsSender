<?php

namespace App\Entities\Order;

use App\Entities\Client\Client;
use App\Entities\Entity;

class Order extends Entity
{
    protected $fillable = [
        'uuid',
        'total',
        'status',
        'client_id'
    ];

    public function orderPackages()
    {
        return $this->belongsToMany(OrderPackage::class);
    }

    public function orderFowards()
    {
        return $this->hasMany(OrderFoward::class);
    }

    public function client()
    {
        return $this->belongsTo(Client::class);
    }

}
