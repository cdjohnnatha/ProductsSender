<?php

namespace App;

class Addon extends Entity
{
    protected $fillable = [
        'service_id',
        'addonable_id',
        'addonable_type',
    ];

    public function addonable(){
        return $this->morphTo();
    }

    public function service(){
        return $this->belongsTo(Service::class);
    }

}
