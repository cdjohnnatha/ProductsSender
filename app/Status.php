<?php

namespace App;

use Spatie\Activitylog\Traits\LogsActivity;

class Status extends Entity
{
    protected $table = 'status';

    protected $fillable = [
        'message'
    ];
}
