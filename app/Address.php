<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Relation;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Activitylog\Traits\LogsActivity;


Relation::morphMap([
   'user' => 'App\User',
    'admin' => 'App\Admin',
    'warehouse' => 'App\Warehouse',
]);

class Address extends Model
{

    protected $attributes = array('default_address' => false);

    protected $fillable = [
        'label',
        'owner_name',
        'owner_surname',
        'company_name',
        'country',
        'address',
        'city',
        'state',
        'postal_code',
        'phone',
        'default_address',
        'addressable_type',
        'addressable_id'
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
        'deleted_at',
        'created_by',
        'updated_by',
        'addressable_type',
        'addressable_id'
    ];

    public function addressable()
    {
        return $this->morphTo();
    }
}
