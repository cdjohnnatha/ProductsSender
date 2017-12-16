<?php

namespace App\Entities\Client;

use App\Entities\Entity;
use App\Entities\Package\Package;
use App\Entities\User;

class Client extends Entity
{
    protected $fillable = [
        'name',
        'surname',
        'phone',
        'rg',
        'cpf',
        'user_id',
        'default_address'
    ];

    public function address()
    {
        return $this->hasMany(ClientAddress::class);
    }

    public function defaultAddress()
    {
        return $this->hasOne(ClientAddress::class, 'id', 'default_address');
    }

    public function packages()
    {
        return $this->hasMany(Package::class, 'object_owner');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function documents()
    {
        return $this->hasMany(ClientDocuments::class);
    }
}
