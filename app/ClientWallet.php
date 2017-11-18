<?php

namespace App;

use Spatie\Activitylog\Traits\LogsActivity;

class ClientWallet extends Entity
{
    protected $attributes = array('balance' => 0);

    public function user()
    {
        return $this->belongsTo(Client::class);
    }
}
