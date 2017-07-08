<?php

namespace Tests\Browser;

use App\Admin;
use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class AdminTest extends DuskTestCase
{

    /**
     * @group admin
     */
    public function testLogin()
    {
        $this->browse(function (Browser $browser) {
            $admin = Admin::find(1);
            $browser->visit('/admin/login')
                ->assertSee('Login')
                ->type('email', $admin->email)
                ->type('password', '123456')
                ->press('Login')
                ->waitForLocation('/admin/dashboard')
                ->assertSee('Dashboard');
        });
    }

    /**
     * @group admin
     */
    public function testNewAdmin()
    {
        $this->browse(function (Browser $browser) {
            $faker = \Faker\Factory::create();
            $browser->loginAs(Admin::find(1))
                ->visit('/admin/dashboard')
                ->assertSee('ADMIN Dashboard')
                ->click('#btn-1')
                ->click('#submenu1')
                ->waitForLocation('/admin/form')
                ->type('name', $faker->firstName)
                ->type('surname', $faker->lastName)
                ->type('phone', '9999999999')
                ->type('email', $faker->email)
                ->select('#country', $faker->country)
                ->type('password', '123456')
                ->type('password_confirmation', '123456')
                ->click('#submit-button')
                ->pause(8000);


        });

    }
}
