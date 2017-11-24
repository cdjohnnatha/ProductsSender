<?php

namespace App\Model\Company;

use App\Entity;

class Company extends Entity
{
    public function phones()
    {
        return $this->hasMany(CompanyPhone::class);
    }
}
