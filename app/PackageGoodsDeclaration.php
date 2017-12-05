<?php

namespace App;

class PackageGoodsDeclaration extends Entity
{
    protected $fillable = [
        'description',
        'quantity',
        'unit_price',
        'total_unit',
    ];
}
