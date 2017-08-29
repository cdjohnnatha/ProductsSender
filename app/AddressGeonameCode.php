<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AddressGeonameCode extends Entity
{
    protected $fillable = [
        'country',
        'city',
        'state',
    ];
}
