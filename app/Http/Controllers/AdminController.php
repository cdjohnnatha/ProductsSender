<?php

namespace App\Http\Controllers;

use App\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{

    public function index()
    {
        $admins = Admin::where('id', '!=', Auth::user()->id);
        return view('admin', compact('admins'));
    }

    public function create()
    {
        return view('admin.FormAdmin');
    }

    public function store(Request $request)
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

    public function show($id)
    {
        return response()->json([
            'admin' => Admin::findOrFail($id)
        ]);
    }

    public function edit(){
        return view('admin.FormAdmin');
    }

    public function update(Request $request, $id)
    {
        $admin = Admin::findOrFail($id);
        $admin->name = $request->input('name');
        $admin->surname = $request->input('surname');
        $admin->email = $request->input('email');
        $admin->country = $request->input('country');

        if($admin->save()){
            return response()->json([
                'admin' => $admin
            ])->setStatusCode(201);
        }
        return response()->setStatusCode(406);

    }

    public function destroy($id)
    {
        $admin = Admin::findOrFail($id);
        $admin->delete();
        if ($admin->trashed()) {
            return response()->setStatusCode(200);
        }

        return response()->setStatusCode(406);
    }
}
