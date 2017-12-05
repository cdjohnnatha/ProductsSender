<?php

namespace App\Entities\Client;

use App\Entities\Entity;

class ClientAddressGeoname extends Entity
{
    protected $fillable = [
        'country',
        'city',
        'state',
    ];
}
