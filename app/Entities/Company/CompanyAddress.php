<?php

namespace App\Entities\Company;

use App\Entities\Entity;

class CompanyAddress extends Entity
{
    protected $fillable = [
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

    public function company()
    {
        return $this->belongsTo(Company::class);
    }
}
