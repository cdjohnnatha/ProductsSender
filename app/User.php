<?php

namespace App;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Spatie\Activitylog\Traits\LogsActivity;

class User extends Authenticatable
{
    use Notifiable;
    use SoftDeletes;
    use LogsActivity;
    protected $dates = ['deleted_at'];
    protected $guard = 'web';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password','name','surname','country','email','subscriptions_id','phone'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token', 'created_at', 'updated_at', 'deleted_at'
    ];

    public function address()
    {
        return $this->morphMany('App\Address', 'addressable');
    }

    public function subscription()
    {
        return $this->hasOne(Subscription::class, 'id', 'subscriptions_id');
    }

    public function wallet()
    {
        return $this->hasOne(Wallet::class, 'user_id');
    }


    public function packages()
    {
        return $this->hasMany(Package::class, 'object_owner');
    }

    public function additionalNames()
    {
        return $this->hasMany(AdditionalNames::class);
    }

    protected static function boot() {
        parent::boot();

        static::deleting(function ($user) {
            $user->wallet()->delete();
        });
    }
}
