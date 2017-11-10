<?php

namespace App;

class AdditionalNames extends Entity
{
    protected $fillable = ['name'];

    protected static $logAttributes = ['name'];

    public function user(){
        return $this->belongsTo(User::class);
    }
}
