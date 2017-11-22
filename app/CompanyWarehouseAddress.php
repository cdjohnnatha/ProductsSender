<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CompanyWarehouseAddress extends Model
{
    protected $fillable = [
        'label',
        'country',
        'street',
        'street2',
        'city',
        'state',
        'number',
        'postal_code',
        'phone',
        'formatted_address',
    ];
}