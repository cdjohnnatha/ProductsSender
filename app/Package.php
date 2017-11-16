<?php

namespace App;

use Spatie\Activitylog\Traits\LogsActivity;

class Package extends Entity
{
    protected $attributes = array('sent' => false);

    protected $fillable = [
        'width',
        'height',
        'depth',
        'weight',
        'unit_measure',
        'weight_measure',
        'object_owner',
        'warehouse_id',
        'status_id',
        'note'
    ];

    protected static $logAttributes = [
        'width',
        'height',
        'depth',
        'weight',
        'unit_measure',
        'weight_measure',
        'object_owner',
        'warehouse_id',
        'default_warehouse_id',
        'status_id'
    ];

    public function user(){
        return $this->belongsTo(User::class, 'object_owner');
    }

    public function status(){
        return $this->belongsTo(Status::class);
    }

    public function warehouse(){
        return $this->belongsTo(Warehouse::class);
    }

    public function pictures(){
        return $this->hasMany(PackageFiles::class, 'package_id');
    }

    public function goods(){
        return $this->hasOne(IncomingPackages::class, 'package_id');
    }
}
