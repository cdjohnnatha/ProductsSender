<?php

namespace App\Entities\Order;

use App\Entities\Entity;
use App\Entities\Package\Package;

class OrderPackage extends Entity
{
    protected $fillable = [
        'package_id',
        'total_addons',
        'order_id',
    ];

    public function orderAddons()
    {
        return $this->hasMany(OrderPackageAddons::class);
    }

    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    public function package()
    {
        return $this->belongsTo(Package::class);
    }


}
