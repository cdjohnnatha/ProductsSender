<?php

namespace App\Entities\Order;

use App\Entities\Client\Client;
use App\Entities\Entity;

class Order extends Entity
{
    protected $fillable = [
        'uuid',
        'total',
        'order_status_id',
        'client_id',
        'company_warehouse_id'
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

    public function orderStatus()
    {
        return $this->belongsTo(OrderStatus::class);
    }

    public function orderFeeRules()
    {
        return $this->hasMany(OrderFeeRules::class);
    }

}
