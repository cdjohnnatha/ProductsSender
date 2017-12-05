<?php

namespace App\Entities\Client;


use App\Entities\Entity;

class ClientDocuments extends Entity
{
    public function documents()
    {
        return $this->belongsTo(Client::class);
    }
}
