<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Activitylog\Traits\LogsActivity;

class Warehouse extends Model
{
    use SoftDeletes;
    use LogsActivity;
    protected $dates = ['deleted_at'];

    protected $fillable = [
        'name', 'storage_time', 'box_price', 'created_by', 'updated_by'
    ];

    public function address()
    {
        return $this->morphOne('App\Address', 'addressable');
    }

    protected $hidden = [
        'created_at', 'updated_at', 'deleted_at', 'created_by', 'updated_by'
    ];
}
