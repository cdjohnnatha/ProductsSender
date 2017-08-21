<?php

use App\Http\Controllers\Controller;
use App\User;

/**
 * Created by PhpStorm.
 * User: claudio
 * Date: 8/22/17
 * Time: 12:16 AM
 */

class UserApiController extends Controller{

    public function suite($id)
    {
        $user = User::findOrFail($id);
        return response()->json([
            'user' => $user
        ]);
    }
}