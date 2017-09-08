<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Addon extends Entity
{
    protected $fillable = [
        'service_id',
        'addonable_id',
        'addonable_type',
    ];

    public function addonable()
    {
        return $this->morphTo();
    }

    public function service()
    {
        return $this->belongsTo(Service::class);
    }

}
