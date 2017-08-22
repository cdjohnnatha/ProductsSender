<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AddressGeonameCode extends Model
{
    protected $fillable = [
        'country',
        'city',
        'state',
    ];
}
