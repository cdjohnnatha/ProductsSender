<?php

namespace App\Http\Controllers;

use App\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin');
    }

    public function listAll()
    {
        return response()->json([
            'users' => Admin::paginate(15)
        ]);
    }

    public function show($id)
    {
        return response()->json([
            'user' => Admin::findOrFail($id)
        ]);
    }

    public function create()
    {
        return view('admin.FormAdmin');
    }

    public function register(Request $request)
    {
        $admin = new Admin();
        $admin->name = $request->input('name');
        $admin->surname = $request->input('surname');
        $admin->email = $request->input('email');
        $admin->phone = $request->input('phone');
        $admin->country = $request->input('country');
        $admin->password = bcrypt($request->input('password'));

        if( $admin->save() ){
            return response('created', 201);
        }
        return response('bad request',400);
    }

    public function update(Request $request, $id)
    {
        $user = Admin::findOrFail($id);
        $user->name = $request->input('name');
        $user->surname = $request->input('surname');
        $user->surname = $request->input('email');
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
        $user = Admin::findOrFail($id);
        if ($user->trashed()) {
            return response()->setStatusCode(200);
        }

        return response()->setStatusCode(406);
    }
}
