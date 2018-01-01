<?php

namespace App\Entities\Company\Warehouse;

use Illuminate\Database\Eloquent\Model;

class FeeRules extends Model
{
    protected $fillable = [
        'initial_fee',
        'max_weight_fee',
        'overweight_fee',
        'company_warehouse_id'
    ];
}
