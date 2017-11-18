<?php

namespace App;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Spatie\Activitylog\Traits\LogsActivity;

class User extends Authenticatable
{
    use SoftDeletes, LogsActivity;

    protected $fillable = [
        'email',
        'password',
        'email',
        'confirmation_code'
    ];


}
