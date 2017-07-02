<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class UserController extends Controller
{

    public function listAll()
    {
        return response()->json([
            'users' => User::paginate(15)
        ]);
    }

    public function show($id)
    {
        return response()->json([
            'user' => User::findOrFail($id)
        ]);
    }

    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);
        $user->name = $request->input('name');
        $user->surname = $request->input('surname');
        $user->surname = $request->input('email');
        $user->surname = $request->input('plan');
        $user->surname = $request->input('phone');

        if($user->save()){
            return response()->json([
                'user' => $user
            ])->setStatusCode(201);
        }

        return response()->setStatusCode(406);

    }

    public function destroy($id)
    {
        $user = User::findOrFail($id);
        if ($user->trashed()) {
            return response()->setStatusCode(200);
        }

        return response()->setStatusCode(406);
    }
}
