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
            $admin = Admin::first();
            $faker = \Faker\Factory::create();
            $browser->loginAs($admin, 'admin')
                ->visit(route('admin.warehouses.create'))
                ->type('warehouse[storage_time]', $faker->numberBetween(0, 60))
                ->type('warehouse[box_price]', $faker->randomFloat(2, 0, 8))
                ->type('address[phone]', $faker->phoneNumber)
                ->type('address[postal_code]', $faker->postcode)
                ->type('address[number]', $faker->buildingNumber)
                ->type('address[label]', $faker->company)
                ->select('admin_id')
                ->type('#map', 'Rua rita porfirio chaves')
                ->waitFor('.pac-item')
                ->click('.pac-item')
                ->pause(400)
                ->press('#submit-button')
                ->pause(8000)
                ->waitForLocation('/admin/warehouses')
                ->assertPathIs('/admin/warehouses');


        });
    }
}
