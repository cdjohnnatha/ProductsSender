<?php

namespace Tests\Browser;

use App\Admin;
use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class AdminLoginTest extends DuskTestCase
{

    /**
     * @group admin
     */
    public function testExample()
    {
        $this->browse(function (Browser $browser) {
            $admin = Admin::find(1);
            $browser->visit('/admin/login')
                ->assertSee('Login')
                ->type('email', $admin->email)
                ->type('password', '123456')
                ->press('Login')
                ->pause(10000)
                ->waitForLocation('/admin/'.$admin->id)
                ->assertSee('Dashboard');
        });
    }
}
