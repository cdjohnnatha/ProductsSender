<?php

namespace App;

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
