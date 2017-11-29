<?php

namespace App\Http\Controllers\Admin;

use App\CompanyWarehouseAddons;
use App\Repositories\CompanyWarehouseAddonRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CompanyWarehouseAddonsController extends Controller
{
    private $companyWarehouseAddonsRepository;

    public function __construct(CompanyWarehouseAddonRepository $companyWarehouseAddons)
    {
        $this->companyWarehouseAddonsRepository = $companyWarehouseAddons;
    }

    public function index()
    {
        $addons = $this->companyWarehouseAddonsRepository->getAll();
        return view('company.warehouse.addon.index', compact('addons'));
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        //
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        //
    }


    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        //
    }
}
