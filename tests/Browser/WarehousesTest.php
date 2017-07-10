<?php

namespace Tests\Browser;

use App\Admin;
use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class WarehousesTest extends DuskTestCase
{

    /**
     * @group warehouse
     */
    public function testRegisterWarehouse()
    {
        $this->browse(function (Browser $browser) {
            $admin = Admin::find(1);
            $faker = \Faker\Factory::create();
            $browser->loginAs($admin, 'admin')
                ->visit('/admin/warehouses/create')
                ->assertSee('Warehouses')
                ->type('nameWarehouse', $faker->company)
                ->type('storageTime', $faker->numberBetween(0, 60))
                ->type('boxPrice', $faker->randomFloat(2, 0, 8))
                ->type('addressLabel', 'Default Address')
                ->type('owner_name', $admin->name)
                ->type('owner_surname', $admin->surname)
                ->type('phone-address', 83998000802)
                ->type('company', '')
                ->type('address', $faker->address)
                ->type('city', $faker->city)
                ->type('state', 'Paraiba')
                ->type('postalCode', $faker->postcode)
                ->select('country-address', $faker->country)
                ->press('#submit-button')
                ->waitForLocation('/admin/warehouses/show-list')
                ->assertPathIs('/admin/warehouses/show-list');
        });
    }
}
