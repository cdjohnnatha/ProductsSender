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
    ];

    public function address()
    {
        return $this->one(CompanyWarehouseAddress::class);
    }

    public function addons()
    {
        return $this->belongsToMany(CompanyWarehouseAddons::class);
    }

}
