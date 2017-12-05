<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;

class Order extends Entity
{
    protected $fillable = [
        'package_id',
        'uuid'
    ];

    public function packages()
    {
        return $this->hasMany(Package::class);
    }

    public function orderPackages()
    {
        return $this->belongsToMany(OrderPackage::class);
    }

    public function orderStatus()
    {
        return $this->hasOne(OrderStatus::class);
    }

    public function orderFowards()
    {
        return $this->hasMany(OrderFoward::class);
    }
}
