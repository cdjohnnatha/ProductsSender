<?php

namespace App\Entities\Order;

use Illuminate\Database\Eloquent\Model;

class OrderFeeWeightRules extends Model
{
    protected $fillable = [
        'total',
        'overweight',
        'fee_weight_rules_id',
        'order_package_id'
    ];
}
