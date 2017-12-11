<?php

namespace App\Entities\Order;

use App\Entities\Entity;
use Illuminate\Database\Eloquent\Model;

class OrderAddons extends Entity
{
    protected $fillable = [
        'price',
        'order_id',
        'company_warehouse_addon_id'
    ];
}
