<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AdditionalServices extends Entity
{

    protected $fillable = [
        'offered_services_id',
        'addable_type',
        'addable_id',
    ];

    public function addable()
    {
        return $this->morphTo();
    }
}
