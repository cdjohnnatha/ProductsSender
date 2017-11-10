<?php

namespace App;

class IncomingPackages extends Entity
{

    protected $attributes = array('registered' => false);

    protected $fillable = [
        'provider',
        'addressee',
        'track_number',
        'total_goods',
        'description',
        'warehouse_id',
        'user_id',
        'package_id',
        'registered',
        'content_type'
    ];

    public function addons(){
        return $this->morphMany(Addon::class, 'addonable');
    }

    public function goodsDeclaration(){
        return $this->hasMany(GoodsDeclaration::class);
    }

    public function warehouse(){
        return $this->belongsTo(Warehouse::class);
    }

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function package(){
        return $this->belongsTo(Package::class);
    }

}
