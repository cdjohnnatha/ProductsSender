<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class UserController extends Controller
{

    public function listAll()
    {
        return response()->json([
            'users' => User::paginate(15),
        ])->setStatusCode(200);
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
        $user->email = $request->input('email');
//        $user->plan = $request->input('plan');
        $user->country = $request->input('country');
        $user->phone = $request->input('phone');

        if($user->save()){
//            return response()->json([
//                'user' => $user
//            ])->setStatusCode(201);
            if(auth()->guard('admin')->user()){
                return redirect('home/all');
            }else {
                return redirect('home/'.$id);
            }

        }

        return response()->setStatusCode(406);
    }

    public function plan(Request $request, $id)
    {
        $user = User::findOrFail($id);
        $user->plan = $request->input('plan');

        if($user->save()){
            return redirect('home');
        }

        return response()->setStatusCode(406);
    }

    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();
        if(auth()->guard('admin')->user()){
            return redirect('home/all');
        }else {
            return redirect('/');
        }
    }
}
