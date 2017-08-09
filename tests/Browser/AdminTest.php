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
     */
    public function testLogin()
    {
        $this->browse(function (Browser $browser) {
            $admin = Admin::find(1);
            $browser->visit(route('admin.login'))
                ->assertSee('Login')
                ->type('email', $admin->email)
                ->type('password', 'holyship123')
                ->press('Login')
                ->waitForLocation('/admin');
        });
    }

    /**
     * @group registerAdmin
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
                ->type('phone', '9999999999')
                ->type('email', $faker->email)
                ->type('password', '123456')
                ->type('password_confirmation', '123456')
                ->click('#submit-button');
        });

    }

    /**
     * @group admin
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
                ->click('#submit-button');
        });
    }

    /**
     * @group admin
     */
    public function testDeleteAdmin()
    {
        $this->browse(function (Browser $browser) {
            $faker = \Faker\Factory::create();
            $delete = DB::table('admins')->orderBy('id', 'desc')->first();
            $browser->loginAs(Admin::find(1), 'admin')
                ->visit(route('admin.index'))
                ->click('#delete-'.$delete->id)
                ->waitForLocation('/admin/');
        });
    }
}
