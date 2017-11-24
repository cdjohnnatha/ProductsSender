<?php

namespace App;

use App\Entity;

class Company extends Entity
{

    protected $fillable = [
        'name',
    ];

    public function phones()
    {
        return $this->hasMany(CompanyPhone::class);
    }

    public function address()
    {
        return $this->hasOne(CompanyAddress::class);
    }
}
