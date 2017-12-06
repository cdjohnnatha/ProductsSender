<?php

namespace Tests\Browser;

use App\Entities\Company\Company;
use App\Entities\User;
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
            $companies = Company::all()->last();
            $faker = \Faker\Factory::create();
            $browser->loginAs($admin->last())
                ->visit(route('admin.companies.warehouses.create', $companies->id))
                ->type('#map', 'Rua rita porfirio chaves')
                ->waitFor('.pac-item')
                ->click('.pac-item')
                ->pause(1500)
                ->type('companyWarehouse[storage_time]', $faker->numberBetween(0, 60))
                ->type('companyWarehouse[name]', $faker->company)
                ->type('companyWarehouse[box_price]', $faker->randomFloat(2, 0, 8))
                ->type('address[postal_code]', $faker->postcode)
                ->type('address[number]', $faker->buildingNumber)
                ->type('phones[0][number]', $faker->phoneNumber)
                ->press('#submit-button')
                ->waitForLocation('/admin/companies/'.$companies->id);
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
            $companies = Company::all()->last();
            $browser->loginAs($admin[0])
                ->visit(route('admin.companies.warehouses.edit', [$companies->id, $companies->warehouses->last()->id]))
                ->type('#map', 'Rua rita porfirio chaves')
                ->waitFor('.pac-item')
                ->click('.pac-item')
                ->pause(1500)
                ->type('companyWarehouse[storage_time]', $faker->numberBetween(0, 60))
                ->type('companyWarehouse[name]', $faker->company)
                ->type('companyWarehouse[box_price]', $faker->randomFloat(2, 0, 8))
                ->type('address[postal_code]', $faker->postcode)
                ->type('address[number]', $faker->buildingNumber)
                ->type('phones[0][number]', $faker->phoneNumber)
                ->press('#submit-button')
                ->waitForLocation('/admin/companies/'.$companies->id);
        });
    }


}
