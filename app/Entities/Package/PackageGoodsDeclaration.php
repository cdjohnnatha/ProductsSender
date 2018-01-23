<?php

namespace App\Entities\Package;

use App\Entities\Entity;

class PackageGoodsDeclaration extends Entity
{
    protected $fillable = [
        'description',
        'quantity',
        'unit_price',
        'total_unit',
        'mass_unit',
        'net_weight'
    ];
}
