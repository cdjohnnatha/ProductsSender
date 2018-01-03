<?php
/**
 * Created by PhpStorm.
 * User: claudio
 * Date: 11/23/17
 * Time: 11:41 PM
 */

namespace App\Repositories;

use App\Entities\Company\CompanyAddons;
use App\Entities\Company\Warehouse\Fees\FeeRules;
use App\Repositories\Interfaces\RepositoryInterface;

class CompanyWarehouseFeeRulesRepository
{
    private $model;
    private $companyWarehouse;

    public function __construct(FeeRules $model, CompanyWarehouseRepository $companyWarehouseRepository)
    {
        $this->model = $model;
        $this->companyWarehouse = $companyWarehouseRepository;
    }

    public function getAll()
    {
        return $this->model->all();
    }

    public function store($request, $warehouseId)
    {
        return $this->companyWarehouse->findById($warehouseId)->feeRules()->create($request->all());
    }

    public function update($id, $request)
    {
        $addon = $this->model->find($id);
        return $addon->update($request->all());

    }

    public function findById($attribute)
    {
        return $this->model->find($attribute);
    }

    public function destroy($id)
    {
        return $this->model->find($id)->delete();
    }
}