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
            $browser->loginAs($admin[0])
                ->visit(route('admin.company-warehouses.create'))
                ->type('#map', 'Rua rita porfirio chaves')
                ->waitFor('.pac-item')
                ->click('.pac-item')
                ->pause(1500)
                ->type('company_warehouse[storage_time]', $faker->numberBetween(0, 60))
                ->type('company_warehouse[name]', $faker->company)
                ->type('company_warehouse[box_price]', $faker->randomFloat(2, 0, 8))
                ->type('address[postal_code]', $faker->postcode)
                ->type('address[number]', $faker->buildingNumber)
                ->type('phones[0][number]', $faker->phoneNumber)
                ->press('#submit-button')
                ->waitForLocation('/admin/company-warehouses');
        });
    }

    /**
     * @group updateCompanyWarehouse
     * @all
     */
    public function testUpdateWarehouse()
    {

        $this->browse(function (Browser $browser) {
            $admin = User::where('type', 'admin')->get();
            $faker = \Faker\Factory::create();
            $warehouses = CompanyWarehouse::all();
            $browser->loginAs($admin[0])
                ->visit(route('admin.company-warehouses.edit', $warehouses->last()->id))
                ->type('#map', 'Rua rita porfirio chaves')
                ->waitFor('.pac-item')
                ->click('.pac-item')
                ->pause(1500)
                ->type('company_warehouse[storage_time]', $faker->numberBetween(0, 60))
                ->type('company_warehouse[name]', $faker->company)
                ->type('company_warehouse[box_price]', $faker->randomFloat(2, 0, 8))
                ->type('address[postal_code]', $faker->postcode)
                ->type('address[number]', $faker->buildingNumber)
                ->type('phones[0][number]', $faker->phoneNumber)
                ->press('#submit-button')
                ->waitForLocation('/admin/company-warehouses');
        });
    }


}
