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
        'provider',
        'addressee',
        'track_number',
        'total_goods',
        'content_type',
        'client_id',
        'package_id',
        'warehouse_id',
        'status_id',
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
        'default_warehouse',
        'status_id',

        'provider',
        'addressee',
        'track_number',
        'total_goods',
        'description',
        'user_id',
        'package_id',
        'content_type'

    ];

    public function user()
    {
        return $this->belongsTo(Client::class, 'object_owner');
    }

    public function packageStatus()
    {
        return $this->hasMany(PackageStatus::class);
    }

    public function warehouse()
    {
        return $this->belongsTo(CompanyWarehouse::class);
    }

    public function pictures()
    {
        return $this->hasMany(PackageFiles::class, 'package_id');
    }

    public function goods()
    {
        return $this->hasOne(IncomingPackages::class, 'package_id');
    }


    public function goodsDeclaration()
    {
        return $this->hasMany(GoodsDeclaration::class);
    }

    public function addons()
    {
        return $this->morphMany(CompanyAddon::class, 'addonable');
    }

    public function order()
    {
        return $this->belongsTo(Order::class);
    }

}
