<?php

namespace Tests\Browser;

use Illuminate\Foundation\Auth\User;
use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class LoginUserTest extends DuskTestCase
{


//    public function testRegister()
//    {
//        $this->browse(function (Browser $browser) {
//            $browser->visit('/register')
//                ->assertSee('Register')
//                ->type('name', 'Claudio')
//                ->type('surname', 'Lourenco')
//                ->type('country', 'Brasil')
//                ->type('email', 'claudio@example.com')
//                ->type('plan', 'free')
//                ->type('phone', '83999999999')
//                ->type('password', '123456')
//                ->type('password_confirmation', '123456')
//                ->press('Register')
//                ->waitForLocation('/home');
//        });
//    }

    public function testExample()
    {


        $this->browse(function (Browser $browser) {
            $user = User::find(1);
            $browser->visit('/login')
                    ->assertSee('Login')
                    ->type('email', $user->email)
                    ->type('password', '123456')
                    ->press('Login')
                    ->waitForLocation('/home/'.$user->id)
                    ->assertSee('Dashboard');
        });
    }


}
