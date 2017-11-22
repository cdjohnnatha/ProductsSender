<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ClientAddress extends Model
{
    protected $fillable = [
        'label',
        'owner_name',
        'owner_surname',
        'company_name',
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

    public function geonames()
    {
        return $this->hasOne(ClientAddressGeoname::class);
    }
}
