<?php

namespace Tests\Browser;

use App\Admin;
use Illuminate\Support\Facades\DB;
use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class AdminTest extends DuskTestCase
{

    /**
     * @group admin
     * @group all
     */
    public function testLogin()
    {
        $this->browse(function (Browser $browser) {
            $admin = Admin::find(1);
            $browser->visit(route('admin.login'))
                ->assertSee('Login')
                ->type('email', $admin->email)
                ->type('password', 'holyship123')
                ->driver->executeScript('window.scrollTo(0, 600);');
            $browser
                ->press('#submit')
                ->waitForLocation('/admin/dashboard');
        });
    }

    /**
     * @group registerAdmin
     * @group admin
     * @group all
     */
    public function testNewAdmin()
    {
        $this->browse(function (Browser $browser) {
            $faker = \Faker\Factory::create();
            $browser->loginAs(Admin::find(1), 'admin')
                ->visit(route('admin.create'))
                ->waitForLocation('/admin/create')
                ->type('name', $faker->firstName)
                ->type('surname', $faker->lastName)
                ->type('phone', $faker->phoneNumber)
                ->type('email', $faker->email)
                ->type('password', '123456')
                ->type('password_confirmation', '123456')
                ->driver->executeScript('window.scrollTo(0, 600);');
            $browser
                ->click('#submit-button')
                ->pause(6000)
                ->waitForLocation('/admin');
        });
    }

    /**
     * @group admin
     * @group all
     */
    public function testEditAdmin()
    {
        $this->browse(function (Browser $browser) {
            $faker = \Faker\Factory::create();
            $browser->loginAs(Admin::find(1), 'admin')
                ->visit(route('admin.edit', 2))
                ->waitForLocation('/admin/2/edit')
                ->type('name', $faker->firstName)
                ->type('surname', $faker->lastName)
                ->type('phone', '9999999999')
                ->type('email', $faker->email)
                ->driver->executeScript('window.scrollTo(0, 600);');
            $browser
                ->click('#submit-button');
        });
    }
}
