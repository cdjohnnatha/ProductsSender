<?php

namespace App\Http\Controllers;

use App\Address;
use App\Subscription;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{

    public function index()
    {
        $users = User::with('subscription')->get();
        return view('user.index', compact('users'));
    }

    public function dashboard()
    {
        return view('home');
    }

    public function create()
    {
        return view('auth.register');
    }

    public function show($id)
    {
        return response()->json(['user' => User::findOrFail($id)]);
    }

    public function edit($id)
    {
        return view('user.edit')->with('user', User::find($id));
    }

    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);
        $user->name = $request->input('name');
        $user->surname = $request->input('surname');
        $user->email = $request->input('email');
        if(!empty($request->input('plan')) || $request->input('plan') != '')
            $user->subscriptions_id = (int) $request->input('plan');
        $user->country = $request->input('country');
        $user->phone = $request->input('phone');

        if($user->save()){
            if(auth()->guard('admin')->user()){
                return redirect('admin/users');
            }else {
                return redirect('user/'.$id);
            }
        }

        return response()->setStatusCode(406);
    }


    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        if(auth()->guard('admin')->user()){
            return response('/admin/users', 200);
        }else {
            return redirect('/');
        }
    }
}
