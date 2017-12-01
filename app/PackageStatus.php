<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PackageStatus extends Model
{
    protected $table = 'package_status';

    protected $fillable = [
        'message'
    ];
}
