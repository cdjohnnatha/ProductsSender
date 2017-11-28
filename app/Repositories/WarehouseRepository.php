<?php
/**
 * Created by PhpStorm.
 * User: claudio
 * Date: 11/17/17
 * Time: 5:26 PM
 */

namespace App\Repositories;


use App\Address;
use App\ClientAddressGeoname;
use App\Admin;
use App\Repositories\Interfaces\RepositoryInterface;
use App\CompanyWarehouse;

class WarehouseRepository implements RepositoryInterface
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
        $warehouse = $this->model::create($request->input('company_warehouse'));
        $warehouse->address()->create($request->input('address'));
        $warehouse->phones()->createMany($request->input('phones'));
//        $warehouse->address->geonames()->create($request->input('geonames'));

    }

    public function update($id, $request)
    {
        $company_warehouse = $this->model::with('address')->find($id);
//        $company_warehouse->address->load('geonames');

        $company_warehouse->update($request->input('company_warehouse'));
        $company_warehouse->address->update($request->input('address'));

        foreach ($request->input('phones') as $phone) {
            $company_warehouse->phones()->updateOrCreate(
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
        $warehouse = $this->model::with('address')->findOrFail($attribute);
        $warehouse->address->geonameCode;

        return $warehouse;
    }

    public function destroy($id)
    {
        return $this->model::findOrFail($id)->delete();
    }
}