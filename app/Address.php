<?php

namespace App;

class Address extends Entity
{
    protected $attributes = array('company_name' => null);

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
        'addressable_type',
        'addressable_id',
    ];

    public function addressable()
    {
        return $this->morphTo();
    }

    public function geonames()
    {
        return $this->hasOne(ClientAddressGeoname::class);
    }
}
