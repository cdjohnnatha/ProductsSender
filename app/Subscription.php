<?php

namespace App;

use Spatie\Activitylog\Traits\LogsActivity;

class Subscription extends Entity
{
    protected $fillable = [
        'title',
        'amount',
        'period',
        'slots',
        'discounts',
    ];

    protected $attributes = [
        'active' => false,
        'principal' => false
    ];

    public function benefits()
    {
        return $this->hasMany(Benefit::class);
    }

    public function addons()
    {
        return $this->morphMany(Addon::class, 'addonable');
    }

    public function servicesIncluded()
    {
        return $this->hasManyThrough(Service::class, Addon::class);
    }
}
