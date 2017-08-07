<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Activitylog\Traits\LogsActivity;

class AdditionalNames extends Entity
{

    protected $fillable = ['name'];

    protected $hidden = [
        'updated_at',
        'deleted_at',
        'created_at'
    ];


    protected static $logAttributes = ['name'];
}
