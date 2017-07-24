<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Activitylog\Traits\LogsActivity;

class Status extends Model
{
    use SoftDeletes;
    use LogsActivity;
    protected $dates = ['deleted_at'];
    protected $table = 'status';

    protected $hidden = [
        'created_at', 'updated_at', 'deleted_at'
    ];




}
