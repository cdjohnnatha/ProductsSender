<?php

namespace App\Entities\Client;

use App\Entities\Entity;
use App\Entities\Invoice\Invoice;
use App\Entities\Order\Order;
use App\Entities\Package\Package;
use App\Entities\PaymentTransaction;
use App\Entities\User;

class Client extends Entity
{
    protected $fillable = [
        'name',
        'surname',
        'identity_document',
        'tax_document',
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

    public function phones()
    {
        return $this->hasMany(ClientPhones::class);
    }

    public function orders()
    {
        return $this->hasMany(Order::class);
    }

    public function invoices()
    {
        return $this->hasMany(Invoice::class);
    }

    public function paymentTransactions()
    {
        return $this->hasMany(PaymentTransaction::class);
    }

    public function walletResult()
    {
        return $this->paymentTransactions()->sum('amount');
    }
}
