<?php

namespace App;

class Package extends Entity
{
    protected $fillable = [
        'provider',
        'store_name',
        'track_number',
        'merchandise',
        'content_type',
        'width',
        'height',
        'depth',
        'unit_measure',
        'weight',
        'weight_measure',
        'total_goods',
        'total_addons',
        'client_id',
        'package_status_id',
        'company_warehouse_id',
        'note'
    ];

    protected static $logAttributes = [
        'provider',
        'store_name',
        'track_number',
        'merchandise',
        'content_type',
        'width',
        'height',
        'depth',
        'unit_measure',
        'weight',
        'weight_measure',
        'total_goods',
        'total_addons',
        'client_id',
        'package_status_id',
        'company_warehouse_id',
        'note'

    ];

    public function client()
    {
        return $this->belongsTo(Client::class);
    }

    public function packageStatus()
    {
        return $this->belongsTo(PackageStatus::class);
    }

    public function warehouse()
    {
        return $this->belongsTo(CompanyWarehouse::class);
    }

    public function pictures()
    {
        return $this->hasMany(PackageFiles::class, 'package_id');
    }


    public function packageGoodsDeclaration()
    {
        return $this->hasMany(PackageGoodsDeclaration::class);
    }

    public function order()
    {
        return $this->belongsTo(Order::class);
    }

}
