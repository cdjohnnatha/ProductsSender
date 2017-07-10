<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Warehouse extends Model
{
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
