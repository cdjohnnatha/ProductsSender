<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class IncomingPackages extends Entity
{

    protected $attributes = array('registered' => false);

    protected $fillable = [
        'provider',
        'addressee',
        'track_number',
        'total_goods',
        'description',
        'warehouse_id'
    ];

    public function addons()
    {
        return $this->morphMany(Addon::class, 'addonable');
    }

    public function services()
    {
        return $this->hasManyThrough(Addon::class, Service::class);
    }

    public function GoodsDeclaration()
    {
        return $this->hasMany(GoodsDeclaration::class);
    }

}
