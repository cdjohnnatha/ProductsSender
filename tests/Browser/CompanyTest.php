<?php

namespace Tests\Browser;

use App\Company;
use App\CompanyWarehouse;
use App\User;
use Illuminate\Contracts\Logging\Log;
use Tests\DuskTestCase;
use Laravel\Dusk\Browser;

class CompanyTest extends DuskTestCase
{

    /**
     * @group registerCompany
     * @all
     */
    public function testRegisterCompany()
    {
        $this->browse(function (Browser $browser) {
            $admin = User::where('type','admin')->get();
            $faker = \Faker\Factory::create();
            $browser->loginAs($admin[0])
                ->visit(route('admin.companies.create'))
                ->type('#map', 'Rua rita porfirio chaves')
                ->waitFor('.pac-item')
                ->click('.pac-item')
                ->pause(1500)
                ->type('company[name]', $faker->numberBetween(0, 60))
                ->type('address[postal_code]', $faker->postcode)
                ->type('address[number]', $faker->buildingNumber)
                ->type('phones[0][number]', $faker->phoneNumber)
                ->press('#submit-button')
                ->waitForLocation('/admin/companies');
        });
    }

    /**
     * @group editCompany
     * @all
     */
    public function testUpdateCompany()
    {
        $this->browse(function (Browser $browser) {
            $admin = User::where('type','admin')->get();
            $faker = \Faker\Factory::create();
            $companies = Company::all();
            $browser->loginAs($admin[0])
                ->visit(route('admin.companies.edit', $companies[0]->id))
                ->type('#map', 'Rua rita porfirio chaves')
                ->waitFor('.pac-item')
                ->click('.pac-item')
                ->pause(1500)
                ->type('company[name]', $faker->numberBetween(0, 60))
                ->type('address[postal_code]', $faker->postcode)
                ->type('address[number]', $faker->buildingNumber)
                ->type('phones[0][number]', $faker->phoneNumber)
                ->press('#addPhones')
                ->type('phones[1][number]', $faker->phoneNumber)
                ->press('#submit-button')
                ->waitForLocation('/admin/companies');
        });
    }


}
