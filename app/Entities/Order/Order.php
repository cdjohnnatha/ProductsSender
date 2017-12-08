<?php

namespace App\Entities\Order;

use App\Entities\Entity;
use App\Entities\Package\Package;
use Illuminate\Database\Eloquent\Model;

class Order extends Entity
{
    protected $fillable = [
        'package_id',
        'uuid',
        'total_addons',
    ];

    public function packages()
    {
        return $this->hasMany(Package::class);
    }

    public function orderPackages()
    {
        return $this->belongsToMany(OrderPackage::class);
    }


    public function orderFowards()
    {
        return $this->hasMany(OrderFoward::class);
    }
}
