<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Client extends Entity
{
    protected $fillable = [
        'name',
        'surname',
        'email',
        'phone',
        'rg',
        'cpf',
    ];

    public function address()
    {
        return $this->hasMany(ClientAddress::class);
    }

    public function defaultAddress()
    {
        return $this->hasOne(Address::class, 'id', 'default_address');
    }

    public function subscription()
    {
        return $this->belongsToMany(ClientSubscriptions::class);
    }

    public function wallet()
    {
        return $this->hasOne(ClientWallet::class, 'user_id');
    }

    public function packages()
    {
        return $this->hasMany(Package::class, 'object_owner');
    }

    public function additionalNames()
    {
        return $this->hasMany(ClientExtraNames::class);
    }

}
