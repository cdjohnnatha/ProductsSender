<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class GoodsDeclaration extends Entity
{
    protected $fillable = [
        'description',
        'quantity',
        'unit_price',
        'total_unit',
    ];
}
