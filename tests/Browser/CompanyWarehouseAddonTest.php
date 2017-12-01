<?php

namespace Tests\Browser;

use App\Company;
use App\CompanyWarehouse;
use App\User;
use Illuminate\Contracts\Logging\Log;
use Tests\DuskTestCase;
use Laravel\Dusk\Browser;

class CompanyWarehouseAddonTest extends DuskTestCase
{

    /**
     * @group registerCompanyWarehouseAddons
     * @all
     */
    public function testRegisterCompanyWarehouse()
    {
        $this->browse(function (Browser $browser) {
            $admin = User::where('type','admin')->get();
            $companies = Company::all()->last();
            $faker = \Faker\Factory::create();
            $browser->loginAs($admin->last())
                ->visit(route('admin.companies.warehouses.addons.create', [$companies->id, $companies->warehouses->last()->id]))
                ->type('price', $faker->randomFloat(2, 1, 5))
                ->press('#submit-button')
                ->waitForLocation('/admin/companies/'.$companies->id.'/warehouses/'.$companies->warehouses->last()->id);
        });
    }

    /**
     * @group updateCompanyWarehouseAddon
     * @all
     */
    public function testUpdateWarehouse()
    {

        $this->browse(function (Browser $browser) {
            $admin = User::where('type', 'admin')->get();
            $faker = \Faker\Factory::create();
            $companies = Company::all()->last();
            $browser->loginAs($admin->last())
                ->visit(route('admin.companies.warehouses.addons.edit',
                    [$companies->id, $companies->warehouses->last()->id, $companies->warehouses->last()->addons->last()->id]))
                ->type('price', $faker->randomFloat(2, 1, 5))
                ->press('#submit-button')
                ->waitForLocation('/admin/companies/'.$companies->id.'/warehouses/'.$companies->warehouses->last()->id);
        });
    }


}
