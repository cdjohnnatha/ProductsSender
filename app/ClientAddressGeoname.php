<?php

namespace App;

class ClientAddressGeoname extends Entity
{
    protected $fillable = [
        'country',
        'city',
        'state',
    ];
}
