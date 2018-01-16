<?php

namespace App\Entities\Company\Warehouse\Fees;

use Illuminate\Database\Eloquent\Model;

class FeeWeightRules extends Model
{
    protected $fillable = [
        'max_weight_fee',
        'overweight_fee',
        'company_warehouse_id',
        'max_weight',
        'overweight'
    ];
}
