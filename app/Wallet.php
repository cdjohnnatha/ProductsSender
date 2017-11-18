<?php

namespace App;

use Spatie\Activitylog\Traits\LogsActivity;

class Wallet extends Entity
{
    protected $attributes = array('balance' => 0);

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
