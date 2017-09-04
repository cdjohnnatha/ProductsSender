<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class IncomingPackages extends Entity
{

    protected $fillable = [
        'provider',
        'addressee',
        'track_number',
        'total_goods',
        'description',
        'warehouse_id'
    ];

    public function additionalService()
    {
        return $this->morphMany(AdditionalServices::class, 'addable');
    }

    public function services()
    {
        return $this->hasManyThrough(AdditionalServices::class, 'offered_services_id');
    }

    public function GoodsDeclaration()
    {
        return $this->hasMany(GoodsDeclaration::class);
    }

}
