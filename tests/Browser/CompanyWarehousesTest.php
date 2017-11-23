<?php

namespace Tests\Browser;

use App\CompanyWarehouse;
use App\User;
use Illuminate\Contracts\Logging\Log;
use Tests\DuskTestCase;
use Laravel\Dusk\Browser;

class CompanyWarehousesTest extends DuskTestCase
{

    /**
     * @group registerCompanyWarehouse
     * @all
     */
    public function testRegisterCompanyWarehouse()
    {
        $this->browse(function (Browser $browser) {
            $admin = User::where('type','admin')->get();
            $faker = \Faker\Factory::create();
            $browser->loginAs(User::find(9))
//                ->visit(route('admin.company-warehouses.create'));
                ->visit('/admin/dashboard')
                ->pause(3000);
//                ->type('warehouse[storage_time]', $faker->numberBetween(0, 60))
//                ->type('warehouse[box_price]', $faker->randomFloat(2, 0, 8))
//                ->type('address[phone]', $faker->phoneNumber)
//                ->type('address[postal_code]', $faker->postcode)
//                ->type('address[number]', $faker->buildingNumber)
//                ->type('address[label]', $faker->company)
//                ->type('#map', 'Rua rita porfirio chaves')
//                ->waitFor('.pac-item')
//                ->click('.pac-item')
//                ->pause(1500)
//                ->press('#submit-button')
//                ->waitForLocation('/admin/warehouses');
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
            $warehouses = CompanyWarehouse::all();
            $browser->loginAs($admin, 'admin')
                ->visit(route('admin.warehouses.edit', $warehouses[0]->id))
                ->type('warehouse[storage_time]', $faker->numberBetween(0, 60))
                ->type('warehouse[box_price]', $faker->randomFloat(2, 0, 8))
                ->type('address[phone]', $faker->phoneNumber)
                ->type('address[postal_code]', $faker->postcode)
                ->type('address[number]', $faker->buildingNumber)
                ->type('address[label]', $faker->company)
                ->type('#map', 'Rua rita porfirio chaves')
                ->waitFor('.pac-item')
                ->click('.pac-item')
                ->pause(1500)
                ->press('#submit-button')
                ->waitForLocation('/admin/warehouses');
        });
    }


}
