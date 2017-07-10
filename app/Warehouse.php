<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Warehouse extends Model
{
    public function address()
    {
        return $this->morphOne('App\Address', 'addressable');
    }
}
