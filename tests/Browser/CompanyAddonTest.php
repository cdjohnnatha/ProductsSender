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
            $browser->loginAs($admin[0])
                ->visit(route('admin.company-addons.create'))
                ->type('addon[title]', $faker->company)
                ->press('#submit-button')
                ->waitForLocation('/admin/company-addons');
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
            $addon = CompanyAddons::all();
            $browser->loginAs($admin[0])
                ->visit(route('admin.company-addons.edit', $addon->last()->id))
                ->type('addon[title]', $faker->company)
                ->press('#submit-button')
                ->waitForLocation('/admin/company-addons');
        });
    }


}
