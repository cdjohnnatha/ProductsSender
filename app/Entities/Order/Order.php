<?php

namespace App\Entities\Order;

use App\Entities\Entity;
use App\Entities\Package\Package;
use Illuminate\Database\Eloquent\Model;

class Order extends Entity
{
    protected $fillable = [
        'uuid',
        'total',
        'status'
    ];

    public function orderPackages()
    {
        return $this->belongsToMany(OrderPackage::class);
    }

    public function orderFowards()
    {
        return $this->hasMany(OrderFoward::class);
    }

    public function orderAddons()
    {
        return $this->hasMany(OrderPackageAddons::class);
    }
}
