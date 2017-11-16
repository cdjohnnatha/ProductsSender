<?php

namespace App;

use Spatie\Activitylog\Traits\LogsActivity;

class Benefit extends Entity
{
    protected $attributes = array('active' => false);

    protected $fillable = [
        'message',
        'active'
    ];

    public function subscription(){
        return $this->belongsTo(Subscription::class);
    }

}
