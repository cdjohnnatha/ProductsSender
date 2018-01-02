<?php

namespace App\Http\Controllers\Web\Admin;

use App\Repositories\CompanyWarehouseFeeWeightRulesRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class FeeWeightRulesController extends Controller
{

    private $feeWeightRules;
    public function __construct(CompanyWarehouseFeeWeightRulesRepository $companyWarehouseFeeWeightRules)
    {
        $this->feeWeightRules = $companyWarehouseFeeWeightRules;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($companyId, $warehouseId)
    {
        $data['companyId'] = $companyId;
        $data['warehouseId'] = $warehouseId;
        return view('company.warehouse.fee_rules.weight.create', compact('data'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $companyId, $warehouseId)
    {
        $this->validate($request, [
            'company_warehouse_id' => 'required|min:1',
            'initial_fee' => 'required|min:0|numeric',
            'max_weight_fee' => 'required|min:0|numeric',
            'overweight_fee' => 'required|min:0|numeric',
        ]);
        $this->feeWeightRules->store($request);

        return redirect(route('admin.companies.warehouses.show', [$companyId, $warehouseId]));
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($companyId, $warehouseId, $feeWeightRulesId)
    {
        $data['companyId'] = $companyId;
        $data['warehouseId'] = $warehouseId;
        $data['feeRule'] = $this->feeWeightRules->findById($feeWeightRulesId);
        return view('company.warehouse.fee_rules.weight.create', compact('data'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $companyId, $warehouseId, $feeWeightRulesId)
    {
        $this->validate($request, [
            'company_warehouse_id' => 'required|min:1',
            'initial_fee' => 'required|min:0|numeric',
            'max_weight_fee' => 'required|min:0|numeric',
            'overweight_fee' => 'required|min:0|numeric',
        ]);

        if($this->feeWeightRules->update($feeWeightRulesId, $request)) {
            return redirect(route('admin.companies.warehouses.show', [$companyId, $warehouseId]));
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($companyId, $warehouseId, $feeWeightRulesId)
    {
        if($this->feeWeightRules->destroy($feeWeightRulesId)){
            return redirect(route('admin.companies.warehouses.show', [$companyId, $warehouseId]));
        }
    }
}
