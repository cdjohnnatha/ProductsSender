<?php

namespace App;

class CompanyWarehouseAddons extends Entity
{
    protected $fillable = [
        'price',
        'company_warehouse_id',
        'company_addon_id'
    ];

    public function companyWarehouse()
    {
        return $this->belongsTo(CompanyWarehouse::class);
    }

    public function companyAddons()
    {
        return $this->belongsTo(CompanyAddons::class);
    }
}
