<?php

namespace Tests\Browser;

use App\Admin;
use App\Warehouse;
use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class WarehousesTest extends DuskTestCase
{

    /**
     * @group registerWarehouse
     * @all
     */
    public function testRegisterWarehouse()
    {
        $this->browse(function (Browser $browser) {
            $admin = Admin::all();
            $faker = \Faker\Factory::create();
            $browser->loginAs($admin[0], 'admin')
                ->visit(route('admin.warehouses.create'))
                ->type('warehouse[storage_time]', $faker->numberBetween(0, 60))
                ->type('warehouse[box_price]', $faker->randomFloat(2, 0, 8))
                ->type('address[phone]', $faker->phoneNumber)
                ->type('address[postal_code]', $faker->postcode)
                ->type('address[number]', $faker->buildingNumber)
                ->type('address[label]', $faker->company)
                ->type('address[company_name]', $faker->company)
                ->type('#map', 'Rua rita porfirio chaves')
                ->waitFor('.pac-item')
                ->click('.pac-item')
                ->pause(1500)
                ->press('#submit-button')
                ->waitForLocation('/admin/warehouses');
        });
    }

    /**
     * @group editWarehouse
     * @all
     */
    public function testUpdateWarehouse()
    {
        $this->browse(function (Browser $browser) {
            $admin = Admin::first();
            $faker = \Faker\Factory::create();
            $warehouses = Warehouse::all();
            $browser->loginAs($admin, 'admin')
                ->visit(route('admin.warehouses.edit', $warehouses[0]->id))
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
                ->pause(500)
                ->press('#submit-button')
                ->waitForLocation('/admin/warehouses');
        });
    }


}
