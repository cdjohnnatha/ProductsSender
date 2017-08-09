<?php

namespace Tests\Browser;

use App\Admin;
use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class WarehousesTest extends DuskTestCase
{

    /**
     * @group registerWarehouse
     */
    public function testRegisterWarehouse()
    {
        $this->browse(function (Browser $browser) {
            $admin = Admin::find(1);
            $faker = \Faker\Factory::create();
            $country = $faker->country;
            $browser->loginAs($admin, 'admin')
                ->visit(route('admin.warehouses.create'))

                ->type('name', $faker->company)
                ->type('storage_time', $faker->numberBetween(0, 60))
                ->type('box_price', $faker->randomFloat(2, 0, 8))
                ->type('#label-name', 'Default Address')
                ->type('owner_name', $faker->firstName)
                ->type('owner_surname', $faker->lastName)
                ->type('phone', $faker->phoneNumber)
                ->type('company_name', $faker->company)
                ->type('address', $faker->streetAddress)
                ->type('#city', $faker->streetName)
                ->type('state', $faker->streetSuffix)
                ->type('postal_code', $faker->postcode)
                ->press('#submit-button')
                ->waitForLocation('/admin/warehouses')
                ->assertPathIs('/admin/warehouses');


        });
    }
}
