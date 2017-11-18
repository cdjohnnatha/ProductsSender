<?php
/**
 * Created by PhpStorm.
 * User: claudio
 * Date: 11/17/17
 * Time: 10:49 PM
 */

namespace App\Repositories;


use App\Package;
use App\Repositories\Interfaces\RepositoryInterface;

class PackageRepository implements RepositoryInterface
{

    private $model;

    public function __construct(Package $package)
    {
        $this->model = $package;
    }

    public function getAll()
    {

    }

    public function getIndexPackages($field, $id, $sent)
    {
        return $this->model::with(['status', 'pictures', 'warehouse', 'goods'])
            ->where($field, $id)
            ->where('sent', $sent)
            ->orderBy('created_at', 'desc')
            ->get();
    }



    public function store($request)
    {
//        $package = new $this->model::create($request->input('package'));
//        $package->status_id = $request->input('status.status_id');
//        $package->warehouse_id = $request->input('warehouse_id');
//
//        $package->save();
//
//        if($request->hasFile('package_files')) {
//            $this->saveImage($request->file('package_files'), $package);
//        }
//
//        if($request->exists('incoming')){
//            $incoming = IncomingPackages::find($request->input('incoming'));
//            $incoming->registered = true;
//            $package->goods()->save($incoming);
//        }
    }

    public function update($id, $request)
    {
        // TODO: Implement update() method.
    }

    public function findById($attribute)
    {
        // TODO: Implement findById() method.
    }

    public function destroy($id)
    {
        // TODO: Implement destroy() method.
    }
}