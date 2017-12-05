<?php

namespace App\Entities\Company;

use App\Entities\Entity;

class CompanyAddons extends Entity
{
    protected $fillable = [
        'title',
        'company_id'
    ];

    public function company()
    {
        return $this->belongsTo(Company::class);
    }
}
