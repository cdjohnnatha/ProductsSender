<?php

namespace App\Entities\Company\Warehouse\Fees;

use Illuminate\Database\Eloquent\Model;

class FeeWeightRules extends Model
{
    protected $fillable = [
        'initial_fee',
        'max_weight_fee',
        'overweight_fee',
        'company_warehouse_id'
    ];
}
