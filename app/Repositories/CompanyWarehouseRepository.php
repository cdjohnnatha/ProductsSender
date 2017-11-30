<?php
/**
 * Created by PhpStorm.
 * User: claudio
 * Date: 11/17/17
 * Time: 5:26 PM
 */

namespace App\Repositories;

use App\Repositories\Interfaces\RepositoryInterface;
use App\CompanyWarehouse;

class CompanyWarehouseRepository implements RepositoryInterface
{

    private $model;


    public function __construct(CompanyWarehouse $model)
    {
        $this->model = $model;
    }

    public function getAll()
    {
        return $this->model::with('address')->get();
    }

    public function store($request)
    {
        $warehouse = $this->model::create($request->input('companyWarehouse'));
        $warehouse->address()->create($request->input('address'));
        $warehouse->phones()->createMany($request->input('phones'));
//        $warehouse->address->geonames()->create($request->input('geonames'));

    }

    public function update($id, $request)
    {
        $companyWarehouse = $this->model::with('address')->find($id);
//        $companyWarehouse->address->load('geonames');

        $companyWarehouse->update($request->input('companyWarehouse'));
        $companyWarehouse->address->update($request->input('address'));

        foreach ($request->input('phones') as $phone) {
            $companyWarehouse->phones()->updateOrCreate(
                ['id' => (int)$phone['id']],
                ['number' => $phone['number']]);
        }

//        if(!empty($warehouse->address->geonames)){
//            $warehouse->address->geonames->update($request->input('geonames'));
//        }
//        else{
//            $warehouse->address->geonames()->create($request->input('geonames'));
//        }

    }

    public function findById($attribute)
    {
        return $this->model::with('address')->findOrFail($attribute);
    }

    public function destroy($id)
    {
        return $this->model::findOrFail($id)->delete();
    }
}