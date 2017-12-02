<?php

namespace Tests\Browser;

use App\Admin;
use App\Package;
use App\User;
use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class AdminPackageTest extends DuskTestCase
{
    /**
     * @group packagesRegister
     * @all
     */
    public function testRegisterPackage()
    {
        $this->browse(function (Browser $browser) {
            $admin = User::where('type','admin')->first();
            $faker = \Faker\Factory::create();
            $browser->loginAs($admin)
                ->visit(route('admin.packages.create'))
                ->pressAndWaitFor('#warehouse_select', 1)
                ->click('#warehouse_select')
                ->type('package[client_id]', 1)
                ->type('package[weight]', $faker->randomFloat(2, 1, 5))
                ->type('package[width]', $faker->randomFloat(2, 1, 5))
                ->type('package[depth]', $faker->randomFloat(2, 1, 5))
                ->type('package[height]', $faker->randomFloat(2, 1, 5))
                ->type('package[quote]', $faker->words)
                ->attach('package_files[]', '/home/claudio/Pictures/package_1.jpg')
                ->driver->executeScript('window.scrollTo(0, 600);');
            $browser
                ->press('#submit-button')
                ->pause(3000)
                ->waitForLocation('/admin/packages');
        });
    }

    /**
     * @group packages
     * @all
     */
    public function testEditPackage()
    {
        $this->browse(function (Browser $browser) {
            $faker = \Faker\Factory::create();
            $admin = Admin::all();
            $admin = $admin[1];
            $packages = Package::all();
            $packages = $packages[0];
            $browser->loginAs($admin, 'admin')
                ->visit(route('admin.packages.edit', $packages->id))
                ->select('warehouse_id', 2)
                ->mouseover('.withripple')
                ->select('.withripple', 2)
                ->type('package[object_owner]', 1)
                ->type('package[weight]', $faker->randomFloat(2, 1, 5))
                ->type('package[width]', $faker->randomFloat(2, 1, 5))
                ->type('package[depth]', $faker->randomFloat(2, 1, 5))
                ->type('package[height]', $faker->randomFloat(2, 1, 5))
                ->type('package[quote]', $faker->words)
                ->attach('package_files[]', '/home/claudio/Pictures/full-1.jpg')
                ->driver->executeScript('window.scrollTo(0, 600);');
            $browser
                ->press('#submit-button')
                ->waitForLocation('/admin/packages');
        });
    }
}
