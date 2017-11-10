<?php

namespace App;

class GoodsDeclaration extends Entity
{
    protected $fillable = [
        'description',
        'quantity',
        'unit_price',
        'total_unit',
    ];
}
