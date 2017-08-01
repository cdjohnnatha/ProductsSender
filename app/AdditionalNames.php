<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Activitylog\Traits\LogsActivity;

class AdditionalNames extends Model
{
    use SoftDeletes;
    use LogsActivity;
    protected $dates = ['deleted_at'];


    protected $hidden = [
        'updated_at', 'deleted_at', 'created_at'
    ];
    protected $fillable = ['name'];

    protected static $logAttributes = ['name'];
}
