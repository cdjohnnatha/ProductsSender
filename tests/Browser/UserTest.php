<?php

namespace Tests\Browser;

use Illuminate\Foundation\Auth\User;
use Illuminate\Support\Facades\DB;
use Tests\DuskTestCase;
use Laravel\Dusk\Browser;

class UserTest extends DuskTestCase
{


    /**
     * @group userRegister
     */
    public function testRegister()
    {

        $this->browse(function (Browser $browser) {
            $faker = \Faker\Factory::create();
            $country = $faker->country;
            $browser->visit('/register')
                ->pause(1000)
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
                ->select('country-address', $country)
                ->assertSelected('country-address', $country)
                ->type('#label', 'Default Address')
                ->type('owner_name', 'Craudio')
                ->type('owner_surname', 'Duarte')
                ->type('phone-address', 83998000802)
                ->type('company', '')
                ->type('address', $faker->address)
                ->type('city', $faker->city)
                ->type('state', 'Paraiba')
                ->type('postal_code', $faker->postcode)
                ->click('#submit-button')
                //Subscription
                ->assertSee('Select Subscription')
                ->mouseover('.columns')
                ->click('.columns')
                ->click('#submit-button')
                ->pause(6000)
                ->waitForLocation('/login');

        });
    }

    /**
     * @group user
     */
    public function testEditUser()
    {
        $this->browse(function (Browser $browser) {
            $user = User::first();
            $browser->loginAs($user)
                ->visit('/home/'.$user->id)
                ->click('.dropdown')
                ->click('#edit')
                ->waitForLocation('/home/'.$user->id.'/edit')
                ->type('surname', 'Duarte')
                ->click('#save')
                ->waitForLocation('/home');
        });
    }


    /**
     * @group user
     */
    public function testDeleteUser()
    {
        $this->browse(function (Browser $browser) {
            $user = User::all()->last();
            $browser->loginAs($user)
                ->visit('/home/'.$user->id)
                ->click('.dropdown-toggle')
                ->click('#delete')
                ->waitForLocation('/');
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
                ->type('email', $user->email)
                ->type('password', '123456')
                ->press('Login')
                ->waitForLocation('/home/'.$user->id);
        });
    }


}
