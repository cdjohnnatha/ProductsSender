<?php

namespace App\Entities;


use App\Entities\Order\Order;
use App\invoiceStatus;

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
