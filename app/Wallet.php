<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Wallet extends Model
{
    use SoftDeletes;
    protected $dates = ['deleted_at'];

    protected $hidden = [
        'created_at', 'updated_at', 'deleted_at'
    ];

    protected $attributes = array('balance' => 0);

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
