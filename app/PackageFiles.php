<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PackageFiles extends Model
{

    use SoftDeletes;
    protected $dates = ['deleted_at'];

    protected $hidden = [
        'created_at', 'updated_at', 'deleted_at', 'package_id'
    ];

    public function package()
    {
        return $this->belongsTo(Package::class);
    }
}
