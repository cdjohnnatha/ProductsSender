<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Spatie\Activitylog\Traits\LogsActivity;

class User extends Authenticatable
{
    use SoftDeletes, LogsActivity;

    protected $attributes = [
        'type' => 'user'
    ];

    protected $fillable = [
        'type',
        'email',
        'password',
        'confirmation_code'
    ];

    public function client()
    {
        return $this->hasOne(Client::class);
    }



}
