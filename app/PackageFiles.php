<?php

namespace App;

use Spatie\Activitylog\Traits\LogsActivity;

class PackageFiles extends Entity
{
    protected $hidden = [
        'package_id'
    ];

    public function package(){
        return $this->belongsTo(Package::class);
    }
}
