<?php

namespace App\Entities\Invoice;


use App\Entities\Entity;
use App\Entities\Order\Order;

class Invoice extends Entity
{

    protected $fillable = [
        'amount',
        'invoice_status_id'
    ];

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
