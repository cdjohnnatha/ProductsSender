<?php

namespace Tests\Browser;

use App\Admin;
use App\CompanyAddon;
use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class ServiceTest extends DuskTestCase
{
    /**
     * @addons
     * @group registerService
     */
    public function testRegisterService()
    {
        $this->browse(function (Browser $browser) {
                $admin = Admin::find(1);
                $faker = \Faker\Factory::create();
                $browser->loginAs($admin, 'admin')
                    ->visit(route('admin.services.create'))
                    ->assertSee('Services')
                    ->type('service[title]', $faker->name)
                    ->type('service[price]', 3.75)
                    ->type('service[description]', $faker->words)
                    ->press('#submit-button')
                    ->waitForLocation('/admin/services');
        });
    }

    /**
     * @group addons
     */
    public function testEditService()
    {
        $this->browse(function (Browser $browser) {
            $admin = Admin::find(1);
            $faker = \Faker\Factory::create();
            $services = CompanyAddon::orderBy('id', 'desc')->first();
            $browser->loginAs($admin, 'admin')
                ->visit(route('admin.services.edit', $services->id))
                ->assertSee('Offered Services')
                ->type('service[title]', $faker->name)
                ->type('service[price]', $faker->randomFloat(2, 0))
                ->type('service[description]', $faker->randomFloat(2, 0))
                ->press('#submit-button')
                ->waitForLocation('/admin/offeredservices');
        });
    }


}
