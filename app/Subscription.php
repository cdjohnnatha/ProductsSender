<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Subscription extends Model
{
    use SoftDeletes;
    protected $dates = ['deleted_at'];

    public function users()
    {
        return $this->belongsToMany(User::class);
    }

    public function createdBy()
    {
        return $this->belongsTo(Admin::class, 'created_by');
    }

    public function updatedBy()
    {
        return $this->belongsTo(Admin::class, 'updated_by');
    }

    public function benefits(){
        return $this->hasMany(Benefit::class);
    }

    protected $hidden = [
        'created_at', 'updated_at', 'deleted_at', 'created_by', 'updated_by'
    ];

    protected static function boot() {
        parent::boot();

        static::deleting(function ($subscription) {
            foreach($subscription->benefits()->get() as $benefit){
                $benefit->delete();
            }
        });
    }

}
