<?php

namespace App\Observers;

use App\Entities\Package\Package;
use Webpatser\Uuid\Uuid;

class PackageObserver
{
    public function created(Package $package)
    {

//        $package->packageOrder()->create(['package_id' => $package->id, 'uuid' => Uuid::generate()]);
//        $message = [
//            'header' => 'Package #'.$package->id.' was registered',
//            'body' => 'You have a new package at '.$package->warehouse->address->label];
//            User::find($package->client)->notify(new PackageNotifications($package, $message));

    }

//    public function updated(Package $package)
//    {
//        User::find($package->object_owner)
//            ->notify(new PackageNotifications($package, [
//                'header' => 'Package #'.$package->id.' was updated',
//                'body' => 'Message TEST'
//            ]));
//    }

//    public function deleting(Package $package){
//        $package->load('pictures');
//        if(!is_null($package->pictures)) {
//            foreach($package->pictures as $picture) {
//                Storage::delete(config('constants.files.full_public_path').$picture->name);
//                $picture->delete();
//
//                // TODO: que código é esse?
////                activity()
////                    ->performedOn($picture)
////                    ->withProperty('package_id', $package->id)
////                    ->withProperty('file_name', $picture->name)
////                    ->log('The package id is :properties.package_id,
////                            removing filename :properties.file_name');
//            }
//        }
//    }
}