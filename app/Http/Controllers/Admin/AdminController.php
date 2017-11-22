<?php

namespace App\Http\Controllers\Admin;

use App\Admin;
use App\Http\Controllers\Controller;
use App\Repositories\AdminRepository;
use App\CompanyWarehouse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;

class AdminController extends Controller
{

    private $admin_repository;

    public function __construct(AdminRepository $model)
    {
        $this->admin_repository = $model;
    }

    public function index()
    {
        $admins = $this->admin_repository->getAll();
        return view('admin.index', compact('admins'));
    }

    public function create()
    {
        $warehouses = CompanyWarehouse::with('address')->get();
        return view('admin.create', compact('warehouses'));
    }

    public function store(Request $request)
    {
        $this->validate($request,[
            'name' => 'bail|required|min:3',
            'surname' => 'required',
            'email' => 'required|string|email|max:255|unique:admins',
            'phone' => 'required|string',
            'default_warehouse' => 'required',
            'password' => 'required|string|min:6|confirmed'
        ]);

        $this->admin_repository->store($request);
        $request->session()->flash('success', 'Admin was successfully created!');
        return redirect(route('admin.index'));
    }

    public function edit($id){
        $admin = $this->admin_repository->findById($id);
        $warehouses = CompanyWarehouse::all();
        return view('admin.create', compact('admin', 'warehouses'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request,[
            'name' => 'bail|required|min:3',
            'surname' => 'required',
            'email' => [
                'required',
                Rule::unique('admins')->ignore($id),
            ],
            'phone' => 'required',
            'default_warehouse' => 'required',
            'password' => 'nullable|confirmed'
        ]);


        $this->admin_repository->update($id, $request);

        $request->session()->flash('success', 'Admin was successfully updated!');
        return redirect(route('admin.index'))->setStatusCode(200);

    }

    public function destroy($id)
    {

        $this->admin_repository->destroy($id);
        return redirect(route('admin.index'))->setStatusCode(200);
    }
}
