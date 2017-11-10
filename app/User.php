<?php

namespace App;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Spatie\Activitylog\Traits\LogsActivity;

class User extends Authenticatable
{
    use Notifiable, SoftDeletes, LogsActivity;

    protected $fillable = [
        'name',
        'email',
        'password',
        'name',
        'surname',
        'country',
        'email',
        'subscriptions_id',
        'phone',
        'rg',
        'cpf',
        'confirmation_code'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
        'created_at',
        'updated_at',
        'deleted_at'
    ];

    public function address(){
        return $this->morphMany(Address::class, 'addressable');
    }

    public function defaultAddress(){
        return $this->hasOne(Address::class, 'id', 'default_address');
    }

    public function subscription(){
        return $this->belongsTo(Subscription::class);
    }

    public function wallet(){
        return $this->hasOne(Wallet::class, 'user_id');
    }

    public function packages(){
        return $this->hasMany(Package::class, 'object_owner');
    }

    public function additionalNames(){
        return $this->hasMany(AdditionalNames::class);
    }

    public function incomingPackages(){
        return $this->hasMany(IncomingPackages::class);
    }
}
