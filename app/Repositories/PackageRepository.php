<?php
/**
 * Created by PhpStorm.
 * User: claudio
 * Date: 11/17/17
 * Time: 10:49 PM
 */

namespace App\Repositories;


use App\Entities\Package\Package;
use App\Entities\Package\PackageFiles;
use App\Repositories\Interfaces\RepositoryInterface;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Webpatser\Uuid\Uuid;

class PackageRepository implements RepositoryInterface
{

    private $model;
    private $allRelations;
    private $companyWarehouseAddonRepository;
    private $orderRepository;
    private $packageStatus;

    public function __construct(
        Package $package,
        CompanyWarehouseAddonRepository $companyWarehouseAddonRepository,
        OrderRepository $orderRepository,
        PackageStatusRepository $packageStatusRepository)
    {
        $this->model = $package;

        $this->allRelations = [
            'client',
            'packageStatus',
            'pictures',
            'goodsDeclaration',
            'orderPackage'
        ];

        $this->companyWarehouseAddonRepository = $companyWarehouseAddonRepository;
        $this->orderRepository = $orderRepository;
        $this->packageStatus = $packageStatusRepository;
    }

    public function getAll()
    {
        return $this->model->with($this->allRelations)->paginate(50);
    }

    public function getCompaniesAllPackages()
    {
//        return $this->model->where('');
    }

    public function getPackagesByStatus($statusType)
    {
        return $this->model->whereHas('packageStatus', function ($query) use ($statusType) {
            $query->where('message', 'like', $statusType);
        })
            ->orderBy('created_at', 'desc')
            ->paginate(50);
    }

    public function getPackagesByStatusClient($clientId, $statusType)
    {
        return $this->model
            ->where('client_id', $clientId)
            ->whereHas('packageStatus', function ($query) use ($statusType) {
                $query->where('message', 'like', $statusType);
            })
            ->with($this->allRelations)
            ->orderBy('created_at', 'desc')
            ->paginate(50);
    }

    public function getUserPackages($userId)
    {
        return $this->model
            ->whereHas('user_id', $userId)
            ->with($this->allRelations)
            ->paginate(30);
    }


    public function store($request)
    {
        $package = $this->model->create($request->input('package'));
        if ($request->has('custom_clearance')) {
            if (is_array($request->input('custom_clearance'))) {
                $customClearance = $request->input('custom_clearance');
            } else {
                $customClearance = json_decode($request->input('custom_clearance'), true);
            }
            $package->goodsDeclaration()->createMany($customClearance);
        }

        if ($request->hasFile('package_files')) {
            $this->saveImage($request->file('package_files'), $package);
        }

        if ($request->has('addons')) {
            $order = $package->orderPackage()->create(
                [
                    'package_id' => $package->id,
                    'total_addons' => $request->input('total_addons')
                ]);

            foreach ($request->input('addons') as $addon) {
                $companyWarehouseAddon = $this->companyWarehouseAddonRepository->findById($addon['company_warehouse_addon_id']);
                $order->orderAddons()->create(
                    [
                        'price' => $companyWarehouseAddon->price,
                        'company_warehouse_addon_id' => $companyWarehouseAddon->id
                    ]);
            }
        } else {
            $package->orderPackage()->create(['package_id' => $package->id]);

        }

        return $package;
    }

    public function update($id, $request)
    {
        $package = Package::findOrFail($id);
        $package->update($request->input('package'));

        if ($request->has('custom_clearance')) {

            foreach ($request->input('custom_clearance') as $goods) {
                if (isset($goods['id'])) {
                    $package->goodsDeclaration()->updateOrCreate(
                        ['id' => $goods['id']],
                        $goods
                    );
                } else {
                    $package->goodsDeclaration()->create($goods);
                }
            }
        }

        if ($request->hasFile('package_files')) {
            $this->saveImage($request->file('package_files'), $package);
        }

    }

    public function findById($attribute)
    {
        return Package::with([
            'pictures',
            'companyWarehouse',
            'packageStatus',
            'client',
            'goodsDeclaration',
            'orderPackage'
        ])->find($attribute);
    }

    public function destroy($id)
    {
        return $this->model->find($id)->delete();
    }

    private function saveImage($files, $package)
    {
        foreach ($files as $key => $file) {
            $fileName = $package->id . date("dmYhmsu");
            $extension = explode('.', $file->getClientOriginalName())[1];
            $fileName = md5($fileName . $key) . '.' . $extension;
            $path = $file->storeAs('public/PackagePictures', $fileName);
            $path = str_replace('public', 'storage', $path);
            $picture = $package->pictures()->create(['name' => $fileName, 'path' => '/' . $path]);

            if ($picture) {
                activity()
                    ->performedOn($package)
                    ->causedBy($package->client->id)
                    ->withProperty('package_id', $package->id)
                    ->withProperty('file_name', $fileName)
                    ->log('The package id is :properties.package_id,
                            the causer name is :causer.name and it was uploaded a file which is :properties.file_name
                            with id:');
            }
        }
    }

    public function destroyImage($id)
    {
        $file = PackageFiles::find($id);

        if ($file) {
            Storage::delete(config('constants.files.full_public_path') . $file->name);
        }

        $file->delete();
    }

    public function getPackagesCheckWarehouse($request)
    {
        $arr = Array();
        foreach ($request->input('packages_id') as $key => $index) {
            $tmp = $this->findById($index);

            if ($key <= 0) {
                $warehouse = $tmp->companyWarehouse->id;
            }

            if ($warehouse != $tmp->companyWarehouse->id) {
                return false;
            }
            array_push($arr, $tmp);
        }

        return $arr;
    }

    public function preparePackage($request)
    {
        foreach ($request->input('packages_id') as $index => $packagesId) {
            $package = $this->findById($packagesId);
            $package->update(['package_status_id' => $this->packageStatus->getStatusFromMessage('PREPARING')->id]);
            $order = $this->orderRepository->store(['uuid' => Uuid::generate(), 'total' => $request->input('total_addons')]);
            $orderPackage = $order->orderPackages()->create(['package_id' => $package->id, 'order_id' => $order->id]);
            $shipment = $request->input('package_shipment')[$index];
            $order->orderFowards()->create(
                [
                    'price' => $shipment['amount'],
                    'address_id' => $shipment['address_id'],
                    'package_id' => $packagesId,
                    'goshippo_shipment' => $shipment['rate_id'],
                ]);

            if ($request->input('package_addons')) {
                $addon = $request->input('package_addons')[$index + 1];
                foreach ($addon['company_warehouse_addon_id'] as $warehouseAddonId) {
                    $companyWarehouseAddon = $this->companyWarehouseAddonRepository->findById($warehouseAddonId);
                    $orderPackage->orderAddons()->create(
                        [
                            'price' => $companyWarehouseAddon->price,
                            'company_warehouse_addon_id' => $companyWarehouseAddon->id,
                        ]);
                }
            }
        }
    }
}