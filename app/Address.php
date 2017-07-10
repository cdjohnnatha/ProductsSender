<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Relation;
use Illuminate\Database\Eloquent\SoftDeletes;


Relation::morphMap([
   'user' => 'App\User',
    'admin' => 'App\Admin',
    'warehouse' => 'App\Warehouse',
]);

class Address extends Model
{
    use SoftDeletes;

    protected $dates = ['deleted_at'];

    protected $fillable = [
        'label','owner_name', 'owner_surname', 'company_name', 'country',
        'address', 'city', 'state', 'postal_code', 'phone', 'default_address', 'addressable_type',
        'addressable_id'
    ];

    public function addressable()
    {
        return $this->morphTo();
    }



}
