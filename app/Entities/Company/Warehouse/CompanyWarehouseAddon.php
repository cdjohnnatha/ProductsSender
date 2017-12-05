<?php

namespace App\Entities\Company\Warehouse;

use App\Entities\Company\CompanyAddons;
use App\Entities\Entity;

class CompanyWarehouseAddon extends Entity
{
    protected $fillable = [
        'price',
        'company_warehouse_id',
        'company_addons_id'
    ];

    public function companyWarehouse()
    {
        return $this->belongsToMany(CompanyWarehouse::class);
    }

    public function companyAddons()
    {
        return $this->belongsTo(CompanyAddons::class);
    }
}
