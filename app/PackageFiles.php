<?php

namespace App;

use Spatie\Activitylog\Traits\LogsActivity;

class PackageFiles extends Entity
{
    public function package(){
        return $this->belongsTo(Package::class);
    }
}
