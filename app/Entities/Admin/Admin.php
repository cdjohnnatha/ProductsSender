<?php

namespace App\Entities\Admin;

use App\Entities\Company\Company;
use App\Entities\Entity;
use App\Entities\User;

class Admin extends Entity
{
    protected $table = 'admin_informations';

    protected $fillable = [
        'fullname',
        'country',
        'phone',
        'email',
        'company_id',
        'user_id'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function company()
    {
        return $this->belongsTo(Company::class);
    }
}
