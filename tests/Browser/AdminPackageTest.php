<?php

namespace Tests\Browser;

use App\Entities\Client\Client;
use App\Entities\Package\Package;
use App\Entities\User;
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
                ->type('custom_clearance[0][quantity]', $faker->numberBetween(1, 5))
                ->type('custom_clearance[0][unit_price]', $faker->randomFloat(2, 1, 2))
                ->click('#add_custom_clearance_button')
                ->type('custom_clearance[1][description]', $faker->words)
                ->type('custom_clearance[1][quantity]', $faker->numberBetween(1, 5))

                ->driver->executeScript('window.scrollTo(0, 600);');
            $browser
                ->press('#submit-button')
                ->pause(5000)
                ->waitForLocation('/admin/packages');
        });
    }

    /**
     * @group updatepackages
     * @all
     */
    public function testEditPackage()
    {
        $this->browse(function (Browser $browser) {
            $admin = User::where('type','admin')->first();
            $faker = \Faker\Factory::create();
            $packages = Package::all()->last();
            $browser->loginAs($admin)
                ->visit(route('admin.packages.edit', $packages->id))
                ->pressAndWaitFor('#warehouse_select', 1)
                ->click('#warehouse_select')
                ->type('#find_suite', 1)
                ->type('package[weight]', $faker->randomFloat(2, 1, 5))
                ->type('package[width]', $faker->randomFloat(2, 1, 5))
                ->type('package[depth]', $faker->randomFloat(2, 1, 5))
                ->type('package[height]', $faker->randomFloat(2, 1, 5))
                ->type('package[note]', $faker->words)
                ->type('package[description]', $faker->words)
                ->attach('package_files[]', '/home/claudio/Pictures/package_1.jpg')
                ->type('custom_clearance[0][description]', $faker->words)
                ->type('custom_clearance[0][quantity]', $faker->numberBetween(1, 5))
                ->type('custom_clearance[0][unit_price]', $faker->randomFloat(2, 1, 5))
                ->click('#add_custom_clearance_button')
                ->type('custom_clearance[1][description]', $faker->words)
                ->type('custom_clearance[1][quantity]', $faker->numberBetween(1, 5))

                ->driver->executeScript('window.scrollTo(0, 600);');
            $browser
                ->press('#submit-button')
                ->waitForLocation('/admin/packages');
        });
    }
}
