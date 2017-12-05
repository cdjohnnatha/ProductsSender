<?php

namespace Tests\Browser;

use App\Admin;
use App\Client;
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
            $client = Client::all()->last();
            $browser->loginAs($admin)
                ->visit(route('admin.packages.create'))
                ->pressAndWaitFor('#warehouse_select', 1)
                ->click('#warehouse_select')
                ->type('#find_suite', $client->id)
                ->type('package[weight]', $faker->randomFloat(2, 1, 5))
                ->type('package[width]', $faker->randomFloat(2, 1, 5))
                ->type('package[depth]', $faker->randomFloat(2, 1, 5))
                ->type('package[height]', $faker->randomFloat(2, 1, 5))
                ->type('package[note]', $faker->words)
                ->attach('package_files[]', '/home/claudio/Pictures/package_1.jpg')
                ->type('custom_clearance[0][description]', $faker->words)
                ->type('custom_clearance[0][quantity]', $faker->numberBetween(1, 1000))
                ->type('custom_clearance[0][unit_price]', $faker->randomFloat(2, 1, 10))
                ->click('#add_custom_clearance_button')
                ->type('custom_clearance[1][description]', $faker->words)
                ->type('custom_clearance[1][quantity]', $faker->numberBetween(1, 1000))

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
            $admin = User::where('type','admin')->first();
            $faker = \Faker\Factory::create();
            $packages = Package::all()->last();
            $browser->loginAs($admin)
                ->pressAndWaitFor('#warehouse_select', 1)
                ->click('#warehouse_select')
                ->type('#find_suite', 1)
                ->type('package[weight]', $faker->randomFloat(2, 1, 5))
                ->type('package[width]', $faker->randomFloat(2, 1, 5))
                ->type('package[depth]', $faker->randomFloat(2, 1, 5))
                ->type('package[height]', $faker->randomFloat(2, 1, 5))
                ->type('package[note]', $faker->words)
                ->attach('package_files[]', '/home/claudio/Pictures/package_1.jpg')
                ->type('custom_clearance[0][description]', $faker->words)
                ->type('custom_clearance[0][quantity]', $faker->numberBetween(1, 1000))
                ->type('custom_clearance[0][unit_price]', $faker->randomFloat(2, 1, 10))
                ->click('#add_custom_clearance_button')
                ->type('custom_clearance[1][description]', $faker->words)
                ->type('custom_clearance[1][quantity]', $faker->numberBetween(1, 1000))

                ->driver->executeScript('window.scrollTo(0, 600);');
            $browser
                ->press('#submit-button')
                ->pause(3000)
                ->waitForLocation('/admin/packages');
        });
    }
}
