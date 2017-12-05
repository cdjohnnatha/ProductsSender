<?php

namespace App\Entities\Company\Warehouse;

use App\Entities\Company\Company;
use App\Entities\Entity;
use Illuminate\Notifications\Notifiable;

class CompanyWarehouse extends Entity
{
    use Notifiable;

    protected $fillable = [
        'storage_time',
        'box_price',
        'name',
        'company_id'
    ];

    public function companyWarehouseAddress()
    {
        return $this->hasOne(CompanyWarehouseAddress::class);
    }

    public function companyWarehouseAddon()
    {
        return $this->belongsToMany(CompanyWarehouseAddon::class);
    }

    public function companyWarehousePhones()
    {
        return $this->hasMany(CompanyWarehousePhones::class);
    }

    public function company()
    {
        return $this->belongsTo(Company::class);
    }

}
