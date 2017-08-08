<?php
/**
 * Created by PhpStorm.
 * User: claudio
 * Date: 8/8/17
 * Time: 10:30 AM
 */
namespace App\Observers;
use App\Events\PackageNotification;
use App\Package;
use Illuminate\Support\Facades\Storage;

class PackageObserver
{
    public function created(Package $package)
    {
        event(new PackageNotification($package));
    }

    public function updated(Package $package)
    {
        event(new PackageNotification($package, 'package'));
        dd($package);
    }

    public function deleting(Package $package)
    {
        foreach ($package->pictures() as $picture)
        {
            Storage::delete($picture->name);
            $picture->delete();
        }
    }
}