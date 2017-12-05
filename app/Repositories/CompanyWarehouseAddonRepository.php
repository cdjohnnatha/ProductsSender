<?php
/**
 * Created by PhpStorm.
 * User: claudio
 * Date: 11/17/17
 * Time: 5:26 PM
 */

namespace App\Repositories;

use App\Entities\Company\Warehouse\CompanyWarehouse;
use App\Entities\Company\Warehouse\CompanyWarehouseAddon;

class CompanyWarehouseAddonRepository
{

    private $model;
    private $companyWarehouse;


    public function __construct(CompanyWarehouseAddon $model, CompanyWarehouse $companyWarehouse)
    {
        $this->model = $model;
        $this->companyWarehouse = $companyWarehouse;
    }

    public function getAll()
    {
        return $this->model::with('companyWarehouse', 'companyAddons')->get();
    }

    public function store($request, $warehouseId)
    {

        return $this->companyWarehouse->find($warehouseId)->addons()->create($request->all());
    }

    public function update($id, $request)
    {
        return $this->model->find($id)->update($request->input());

    }

    public function findById($attribute)
    {
        return $this->model->find($attribute);
    }

    public function destroy($id)
    {
        return $this->model::findOrFail($id)->delete();
    }
}