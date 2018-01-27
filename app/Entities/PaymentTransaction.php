<?php

namespace App\Entities;

use App\Entities\Client\Client;
use Illuminate\Database\Eloquent\Model;

class PaymentTransaction extends Model
{
    protected $fillable = [
        'client_id',
        'amount',
        'payment_type'
    ];

    public function client()
    {
        return $this->belongsTo(Client::class);
    }
}
