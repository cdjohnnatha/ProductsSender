<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;
use Spatie\Activitylog\Traits\LogsActivity;

class Entity extends Model
{
    use SoftDeletes;
    use LogsActivity;
    protected $dates = ['deleted_at'];


}
