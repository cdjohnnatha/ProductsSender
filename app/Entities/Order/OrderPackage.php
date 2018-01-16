<?php

namespace App\Entities\Order;

use App\Entities\Entity;
use App\Entities\Package\Package;

class OrderPackage extends Entity
{
    protected $fillable = [
        'package_id',
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

    public function orderFeeWeightRules()
    {
        return $this->hasOne(OrderFeeWeightRules::class);
    }

    public function orderPackageFeeRules()
    {
        return $this->hasMany(OrderPackageFeeRules::class);
    }


}
