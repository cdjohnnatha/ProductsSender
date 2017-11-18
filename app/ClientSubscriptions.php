<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ClientSubscriptions extends Entity
{
    protected $fillable = [
        'client_id',
        'plan_id',
    ];

    public function client()
    {
        return $this->hasMany(Client::class);
    }

    public function subscription()
    {
        return $this->hasMany(CompanySubscription::class);
    }
}
