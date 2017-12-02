<?php

namespace App;

use Spatie\Activitylog\Traits\LogsActivity;

//TODO Analisar se o tamanho do pacote.

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


    public function goodsDeclaration()
    {
        return $this->hasMany(GoodsDeclaration::class);
    }

    public function order()
    {
        return $this->belongsTo(Order::class);
    }

}
