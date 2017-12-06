<?php

namespace App\Entities\Package;

use App\Entities\Client\Client;
use App\Entities\Company\Warehouse\CompanyWarehouse;
use App\Entities\Entity;
use App\Entities\Order;

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
        'note',
        'description'
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

    public function companyWarehouse()
    {
        return $this->belongsTo(CompanyWarehouse::class);
    }

    public function pictures()
    {
        return $this->hasMany(PackageFiles::class, 'package_id');
    }


    public function goodsDeclaration()
    {
        return $this->hasMany(PackageGoodsDeclaration::class);
    }

    public function packageOrder()
    {
        return $this->belongsTo(Order::class);
    }

}
