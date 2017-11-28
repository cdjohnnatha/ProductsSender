<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Spatie\Activitylog\Traits\LogsActivity;

class CompanyWarehouse extends Entity
{
    use Notifiable;

    protected $fillable = [
        'storage_time',
        'box_price',
        'name',
        'company_id'
    ];

    public function address()
    {
        return $this->hasOne(CompanyWarehouseAddress::class);
    }

    public function addons()
    {
        return $this->belongsToMany(CompanyWarehouseAddons::class);
    }

    public function phones()
    {
        return $this->hasMany(CompanyWarehousePhones::class);
    }

}
