<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Activitylog\Traits\LogsActivity;

class Subscription extends Entity
{

    protected $hidden = [
        'created_at',
        'updated_at',
        'deleted_at',
        'created_by',
        'updated_by'
    ];

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



    protected static function boot() {
        parent::boot();

        static::deleting(function ($subscription) {
            foreach($subscription->benefits()->get() as $benefit){
                $benefit->delete();
            }
        });
    }

}
