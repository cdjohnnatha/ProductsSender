<?php

namespace App\Entities\Company\Warehouse\Fees;

use Illuminate\Database\Eloquent\Model;

class FeeRules extends Model
{
    protected $fillable = [
        'title',
        'amount'
    ];
}
