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
                ->click('#submit-button')
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
                ->click('#submit-button');
        });
    }

    /**
     * @admin
     * @group delete_admin
     */
    public function testDeleteAdmin()
    {
        $this->browse(function (Browser $browser) {
            $faker = \Faker\Factory::create();
            $delete = Admin::orderBy('id', 'desc')->first();
            $admin = Admin::all();
            $browser->loginAs($admin[count($admin) - 1], 'admin')
                ->visit(route('admin.index'))
                ->click('#delete-button-'.$delete->id)
                ->press('.swal2-confirm')
                ->waitFor('.swal2-confirm')
                ->press('.swal2-confirm')
                ->waitForLocation('/admin');
        });
    }
}
