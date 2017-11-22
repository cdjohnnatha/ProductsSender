<?php

namespace App;


class ClientDocuments extends Entity
{
    public function documents()
    {
        return $this->belongsTo(Client::class);
    }
}
