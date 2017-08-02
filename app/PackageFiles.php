<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Activitylog\Traits\LogsActivity;

class PackageFiles extends Entity
{

    protected $hidden = [
        'created_at',
        'updated_at',
        'deleted_at',
        'package_id'
    ];

    public function package()
    {
        return $this->belongsTo(Package::class);
    }
}
