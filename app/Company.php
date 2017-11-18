<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Company extends Entity
{
    public function phones()
    {
        return $this->hasMany(CompanyPhone::class);
    }
}
