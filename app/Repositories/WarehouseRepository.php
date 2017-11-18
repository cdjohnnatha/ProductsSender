<?php
/**
 * Created by PhpStorm.
 * User: claudio
 * Date: 11/17/17
 * Time: 5:26 PM
 */

namespace App\Repositories;


use App\Address;
use App\AddressGeonameCode;
use App\Admin;
use App\Repositories\Interfaces\RepositoryInterface;
use App\CompanyWarehouse;

class WarehouseRepository implements RepositoryInterface
{

    private $model;
    private $address_model;
    private $admin_model;

    public function __construct(CompanyWarehouse $model, Address $address_model, AdminRepository $admin_model, AddressGeonameCode $geoname_model)
    {
        $this->model = $model;
        $this->address_model = $address_model;
        $this->admin_model = $admin_model;
    }

    public function getAll()
    {
        return $this->model::with('address')->get();
    }

    public function store($request)
    {
        $warehouse = $this->model::create($request->input('warehouse'));
        $address = new $this->address_model($request->input('address'));
        $geonames = new AddressGeonameCode($request->input('geonames'));

        $admin = $this->admin_model->findById($request->input('admin_id'));

        $address->owner_name = $admin->name;
        $address->owner_surname = $admin->surname;
        $address->company_name = 'Holyship';

        $warehouse->address()->save($address);
        $warehouse->address->geonames()->save($geonames);
    }

    public function update($id, $request)
    {
        $warehouse = $this->model::with('address')->find($id);
        $warehouse->address->load('geonames');

        $warehouse->update($request->input('warehouse'));
        $warehouse->address->update($request->input('address'));

        if(!empty($warehouse->address->geonames)){
            $warehouse->address->geonames->update($request->input('geonames'));
        }
        else{
            $warehouse->address->geonames()->create($request->input('geonames'));
        }

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