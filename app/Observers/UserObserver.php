<?php

namespace App\Observers;

use App\Entities\Package\Package;
use App\Entities\User;
use Illuminate\Support\Facades\Hash;
use Webpatser\Uuid\Uuid;

class UserObserver
{
    public function created(User $user)
    {
        $user->password = Hash::make($user->password);
        $user->confirmation_code = base64_encode($user->email);
        $user->save();
    }


}