<?php

namespace Tests\Browser;

use Illuminate\Foundation\Auth\User;
use Tests\DuskTestCase;
use Laravel\Dusk\Browser;

class UserTest extends DuskTestCase
{
    /**
     * @group user
     */
    public function testRegister()
    {

        $this->browse(function (Browser $browser) {
            $faker = \Faker\Factory::create();
            $browser->visit('/register')
                ->assertSee('Register User')
                ->type('name', $faker->firstName)
                ->type('surname', $faker->lastName)
                ->type('phone', 83998000802)
                ->select('#country', 'Brazil')
                ->type('email', $faker->email)
                ->type('password', '123456')
                ->type('password_confirmation', '123456')
                ->click('#submit-button')
                //Address form
                ->assertSee('Register Address')
                ->type('addressLabel', 'Default Address')
                ->type('owner_name', 'Craudio')
                ->type('owner_surname', 'Duarte')
                ->type('phone-address', 83998000802)
                ->type('company', '')
                ->type('address', $faker->address)
                ->type('city', $faker->city)
                ->type('state', 'Paraiba')
                ->type('postalCode', $faker->postcode)
                ->select('country-address', $faker->country)
                ->click('#submit-button')
                //Subscription
                ->assertSee('Select Subscription')
                ->mouseover('.columns')
                ->click('.columns')
                ->click('#submit-button')
                ->waitForLocation('/login');

        });
    }

    /**
     * @group user
     */
    public function testLogin()
    {
        $this->browse(function (Browser $browser) {
            $user = User::find(1);
            $browser->visit('/login')
                ->assertSee('Login')
                ->type('login', $user->email)
                ->type('password', '123456')
                ->press('Login')
                ->waitForLocation('/home/'.$user->id)
                ->assertSee('Dashboard');
        });
    }


//    public function testEditUser()
//    {
//        $this->browse(function (Browser $browser) {
//            $user = User::find(1);
//            $browser->loginAs($user)
//                ->visit('/home/'.$user->id)
//                ->click('.dropdown')
//                ->click('#edit')
//                ->waitForLocation('/home/'.$user->id.'/edit')
//                ->type('surname', 'Duarte')
//                ->click('#save')
//                ->waitForLocation('/home/'.$user->id);
//        });
//    }

//    public function testDeleteUser()
//    {
//        $this->browse(function (Browser $browser) {
//            $user = factory(\App\User::class)->create();
//            $browser->loginAs($user)
//                ->visit('/home/'.$user->id)
//                ->click('.dropdown')
//                ->click('#delete')
//                ->waitForLocation('/');
//        });
//    }


}
