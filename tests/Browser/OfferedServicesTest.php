<?php

namespace Tests\Browser;

use App\Admin;
use App\OfferedService;
use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class OfferedServicesTest extends DuskTestCase
{
    /**
     * @services
     * @group registerService
     */
    public function testRegisterService()
    {
        $this->browse(function (Browser $browser) {
                $admin = Admin::find(1);
                $faker = \Faker\Factory::create();
                $browser->loginAs($admin, 'admin')
                    ->visit(route('admin.offeredservices.create'))
                    ->assertSee('Offered Services')
                    ->type('service[title]', $faker->name)
                    ->type('service[price]', $faker->randomFloat(2, 0))
                    ->type('service[description]', $faker->randomFloat(2, 0))
                    ->press('#submit-button')
                    ->waitForLocation('/admin/offeredservices');
        });
    }

    /**
     * @group services
     */
    public function testEditService()
    {
        $this->browse(function (Browser $browser) {
            $admin = Admin::find(1);
            $faker = \Faker\Factory::create();
            $services = OfferedService::orderBy('id', 'desc')->first();
            $browser->loginAs($admin, 'admin')
                ->visit(route('admin.offeredservices.edit', $services->id))
                ->assertSee('Offered Services')
                ->type('service[title]', $faker->name)
                ->type('service[price]', $faker->randomFloat(2, 0))
                ->type('service[description]', $faker->randomFloat(2, 0))
                ->press('#submit-button')
                ->waitForLocation('/admin/offeredservices');
        });
    }


}
