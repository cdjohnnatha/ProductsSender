<?php

namespace App\Http\Controllers\Web\Admin;

use App\Repositories\CompanyWarehouseFeesRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class FeeRulesController extends Controller
{

    private $feeRules;
    public function __construct(CompanyWarehouseFeesRepository $companyWarehouseFeesRepository)
    {
        $this->feeRules = $companyWarehouseFeesRepository;
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
        return view('company.warehouse.fees.create', compact('data'));
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
        $this->feeRules->store($request);

        return redirect(route('admin.companies.warehouses.show', [$companyId, $warehouseId]));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
