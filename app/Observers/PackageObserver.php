<?php
/**
 * Created by PhpStorm.
 * User: claudio
 * Date: 8/8/17
 * Time: 10:30 AM
 */
namespace App\Observers;
use App\Events\Event;
use App\Events\PackageNotification;
use App\Notifications\PackageNotifications;
use App\Package;
use App\User;
use Illuminate\Support\Facades\Storage;

class PackageObserver
{
    public function created(Package $package)
    {
        event(new PackageNotification($package, 'Registered new package'));
        User::find($package->object_owner)
            ->notify(new PackageNotifications($package, 'TESTING'));
    }

    public function updated(Package $package)
    {
        event(new PackageNotification($package, 'Updated a package'));
        User::find($package->object_owner)
            ->notify(new PackageNotifications($package, 'TESTING'));
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