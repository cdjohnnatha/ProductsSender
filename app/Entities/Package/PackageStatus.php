<?php

namespace App\Entities\Package;

use App\Entities\Entity;

class PackageStatus extends Entity
{
    protected $table = 'package_status';

    protected $fillable = [
        'message'
    ];
}
