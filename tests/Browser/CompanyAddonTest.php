<?php

namespace Tests\Browser;

use App\Company;
use App\CompanyAddons;
use App\CompanyWarehouse;
use App\User;
use Illuminate\Contracts\Logging\Log;
use Tests\DuskTestCase;
use Laravel\Dusk\Browser;

class CompanyAddonTest extends DuskTestCase
{

    /**
     * @group registerCompanyAddon
     */
    public function testRegisterCompanyAddon()
    {
        $this->browse(function (Browser $browser) {
            $admin = User::where('type','admin')->get();
            $faker = \Faker\Factory::create();
            $companies = Company::all()->last();

            $browser->loginAs($admin[0])
                ->visit(route('admin.companies.addons.create', $companies->id))
                ->type('addon[title]', $faker->company)
                ->press('#submit-button')
                ->waitForLocation('/admin/companies/'.$companies->id);
        });
    }

    /**
     * @group editCompanyAddon
     * @all
     */
    public function testUpdateCompany()
    {
        $this->browse(function (Browser $browser) {
            $admin = User::where('type','admin')->get();
            $faker = \Faker\Factory::create();
            $companies = Company::all()->last();
            $browser->loginAs($admin[0])
                ->visit(route('admin.companies.addons.edit', [$companies->id, $companies->addons->last()->id]))
                ->type('addon[title]', $faker->company)
                ->press('#submit-button')
                ->waitForLocation('/admin/companies/'.$companies->id);
        });
    }


}
