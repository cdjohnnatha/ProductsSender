<?php

namespace App\Http\Controllers\Web\Admin;

use App\Admin;
use App\Entities\Company\Warehouse\CompanyWarehouse;
use App\Http\Controllers\Controller;
use App\Repositories\AdminRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;

class AdminController extends Controller
{

    private $adminRepository;

    public function __construct(AdminRepository $model)
    {
        $this->adminRepository = $model;
    }

    public function index()
    {
        $admins = $this->adminRepository->getAll();
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

        $this->adminRepository->store($request);
        $request->session()->flash('success', 'Admin was successfully created!');
        return redirect(route('admin.index'));
    }

    public function edit($id){
        $admin = $this->adminRepository->findById($id);
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


        $this->adminRepository->update($id, $request);

        $request->session()->flash('success', 'Admin was successfully updated!');
        return redirect(route('admin.index'))->setStatusCode(200);

    }

    public function destroy($id)
    {

        $this->adminRepository->destroy($id);
        return redirect(route('admin.index'))->setStatusCode(200);
    }
}
