<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Activitylog\Traits\LogsActivity;

class Wallet extends Entity
{
    protected $hidden = [
        'created_at',
        'updated_at',
        'deleted_at'
    ];

    protected $attributes = array('balance' => 0);

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}