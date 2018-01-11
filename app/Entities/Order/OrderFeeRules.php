<?php

namespace App\Entities\Order;

use Illuminate\Database\Eloquent\Model;

class OrderFeeRules extends Model
{
    protected $fillable = [
        'order_id',
        'price',
        'fee_rules_id'
    ];
}
