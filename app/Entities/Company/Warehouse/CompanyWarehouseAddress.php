<?php

namespace App\Entities\Company\Warehouse;

use Illuminate\Database\Eloquent\Model;

class CompanyWarehouseAddress extends Model
{
    protected $fillable = [
        'country',
        'street',
        'street2',
        'city',
        'state',
        'number',
        'postal_code',
        'formatted_address',
    ];

    public function warehouse()
    {
        return $this->belongsTo(CompanyWarehouse::class);
    }
}
