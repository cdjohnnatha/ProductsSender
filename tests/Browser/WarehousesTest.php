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
            $country = $faker->country;
            $browser->loginAs($admin, 'admin')
                ->visit('/admin/warehouses/create')
                ->assertSee('Warehouses')
                ->select('country-address', $country)
                ->type('name', $faker->company)
                ->type('storage_time', $faker->numberBetween(0, 60))
                ->type('box_price', $faker->randomFloat(2, 0, 8))
                ->type('#label', 'Default Address')
                ->type('owner_name', $admin->name)
                ->type('owner_surname', $admin->surname)
                ->type('phone-address', 83998000802)
                ->type('company', '')
                ->type('address', $faker->address)
                ->type('city', $faker->city)
                ->type('state', 'Paraiba')
                ->type('postal_code', $faker->postcode)
                ->press('#submit-button')
                ->waitForLocation('/admin/warehouses/show-list')
                ->assertPathIs('/admin/warehouses/show-list');
        });
    }
}
