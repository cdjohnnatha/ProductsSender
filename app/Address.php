<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Address extends Entity
{

    protected $attributes = array('default_address' => false, 'company_name' => null);

    protected $fillable = [
        'label',
        'owner_name',
        'owner_surname',
        'company_name',
        'country',
        'street',
        'city',
        'state',
        'number',
        'postal_code',
        'phone',
        'default_address',
        'formatted_address',
        'addressable_type',
        'addressable_id',
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
        'deleted_at',
        'created_by',
        'updated_by',
        'addressable_type',
        'addressable_id'
    ];

    public function addressable()
    {
        return $this->morphTo();
    }

    public function geonames()
    {
        return $this->hasOne(AddressGeonameCode::class);
    }
}
