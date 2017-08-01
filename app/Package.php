<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Activitylog\Traits\LogsActivity;

class Package extends Model
{
    use SoftDeletes;
    use LogsActivity;
    protected $dates = ['deleted_at'];

    protected $attributes = ['read' => false];

    protected $hidden = [
        'updated_at', 'deleted_at', 'status_id'
    ];
    protected static $logAttributes = [
        'width', 'height', 'depth','weight','unit_measure', 'weight_measure',
        'object_owner','warehouse_id', 'default_warehouse_id', 'status_id'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'object_owner');
    }

    public function status()
    {
        return $this->belongsTo(Status::class, 'status_id');
    }

    public function warehouse()
    {
        return $this->belongsTo(Warehouse::class, 'warehouse_id');
    }

    public function pictures()
    {
        return $this->hasMany(PackageFiles::class, 'package_id');
    }

    protected static function boot() {
        parent::boot();

        static::deleting(function ($user) {
            $user->pictures()->delete();
        });
    }

    /**
     * Log configure
     */

    /**
     * @param string $eventName before write at log
     * @return string the name of event
     */
    public function getLogNameToUse(string $eventName = ''): string
    {
        return 'Package';
    }

    public function getDescriptionForEvent(string $eventName): string
    {
        return "Package has been {$eventName}";
    }

}
