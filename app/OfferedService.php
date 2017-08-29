<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OfferedService extends Entity
{
    protected $fillable = [
        'title',
        'price',
        'description',
    ];
}
