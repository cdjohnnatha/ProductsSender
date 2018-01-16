<?php

namespace App\Entities\Order;

use App\Entities\Company\Warehouse\Fees\FeeRules;
use Illuminate\Database\Eloquent\Model;

class OrderPackageFeeRules extends Model
{
    protected $fillable = [
        'order_package_id',
        'price',
        'fee_rules_id'
    ];

    public function feeRules()
    {
        return $this->belongsTo(FeeRules::class);
    }

    public function order()
    {
        return $this->belongsTo(Order::class);
    }
}
