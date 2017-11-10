<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Spatie\Activitylog\Traits\LogsActivity;

class Warehouse extends Entity
{
    use Notifiable;

    protected $fillable = [
        'storage_time',
        'box_price',
    ];

    public function address(){
        return $this->morphOne(Address::class, 'addressable');
    }

}
