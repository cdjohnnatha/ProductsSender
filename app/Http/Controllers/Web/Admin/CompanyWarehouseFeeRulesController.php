<?php

namespace App\Http\Controllers\Web\Admin;

use App\Repositories\CompanyWarehouseFeeRulesRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CompanyWarehouseFeeRulesController extends Controller
{
    private $feeRules;

    public function __construct(CompanyWarehouseFeeRulesRepository $companyWarehouseFeeRulesRepository)
    {
        $this->feeRules = $companyWarehouseFeeRulesRepository;
    }

    public function create($companyId, $warehouseId)
    {
        $data['companyId'] = $companyId;
        $data['warehouseId'] = $warehouseId;

        return view('company.warehouse.fee_rules.create', compact('data'));
    }

    public function store(Request $request, $companyId, $warehouseId)
    {
        $this->validate($request, [
            'title' => 'required|string',
            'amount' => 'required|min:0|numeric'
        ]);
        if($this->feeRules->store($request, $warehouseId)) {
            return redirect(route('admin.companies.warehouses.show', [$companyId, $warehouseId]));
        }

    }

    public function edit($companyId, $warehouseId, $feeRulesId)
    {
        $data['feeRule'] = $this->feeRules->findById($feeRulesId);
        $data['companyId'] = $companyId;
        $data['warehouseId'] = $warehouseId;
        return view('company.warehouse.fee_rules.create', compact('data'));
    }


    public function update(Request $request, $companyId, $warehouseId, $feeRulesId)
    {
        $this->validate($request, [
            'title' => 'required|string',
            'amount' => 'required|min:0|numeric'
        ]);

        if($this->feeRules->update($feeRulesId, $request)) {
            return redirect(route('admin.companies.warehouses.show', [$companyId, $warehouseId]));
        }
    }


    public function destroy($companyId, $warehouseId, $feeRulesId)
    {
        if($this->feeRules->destroy($feeRulesId)){
            return redirect()->back();
        }
    }
}
