<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PackageStatus extends Entity
{
    protected $table = 'package_status';

    protected $fillable = [
        'status_message'
    ];

}
