<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Package extends Model
{
    use SoftDeletes;
    protected $dates = ['deleted_at'];

    protected $hidden = [
        'created_at', 'updated_at', 'deleted_at', 'status_id', 'object_owner', 'warehouse_id'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'object_owner');
    }

    public function status()
    {
        return $this->belongsTo(Status::class, 'status_id');
    }

    public function warehouse()
    {
        return $this->belongsTo(Warehouse::class, 'warehouse_id');
    }
}
