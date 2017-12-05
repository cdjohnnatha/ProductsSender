<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Invoice extends Entity
{
    public function invoiceOrder()
    {
        return $this->belongsToMany(Order::class);
    }

    public function invoiceStatus()
    {
        return $this->hasOne(InvoiceStatus::class);
    }

    public function invoiceTransaction()
    {
        return $this->hasMany(InvoiceTransaction::class);
    }
}
