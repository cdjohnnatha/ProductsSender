<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OrderFoward extends Entity
{
    public function orderFowardsAddons()
    {
        return $this->belongsToMany(OrderFowardAddons::class);
    }
}
