<?php

namespace App\Entities\Package;

use App\Entities\Entity;
use Spatie\Activitylog\Traits\LogsActivity;

class PackageFiles extends Entity
{
    protected $fillable = [
        'path',
        'name',
    ];

    public function package()
    {
        return $this->belongsTo(Package::class);
    }
}
