<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Activitylog\Traits\LogsActivity;

class Benefit extends Entity
{

    protected $hidden = [
        'id',
        'created_at',
        'updated_at',
        'deleted_at',
        'subscription_id',
    ];

    public function subscription()
    {
        return $this->belongsTo(Subscription::class, 'subscription_id');
    }

}
