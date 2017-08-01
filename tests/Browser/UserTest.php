<?php

namespace Tests\Browser;

use Illuminate\Foundation\Auth\User;
use Illuminate\Support\Facades\DB;
use Tests\DuskTestCase;
use Laravel\Dusk\Browser;

class UserTest extends DuskTestCase
{

    private $prefixUrl = '/user/';
    /**
     * @group userRegister
     * @group CRUDS
     */
    public function testRegister()
    {

        $this->browse(function (Browser $browser) {
            $faker = \Faker\Factory::create();
            $country = $faker->countryCode;
            $browser->visit('/register')
                ->pause(1000)
                ->assertSee('Register User')
                ->type('name', $faker->firstName)
                ->type('surname', $faker->lastName)
                ->type('phone', 83998000802)
                ->select('#countryUser', $country)
                ->type('email', $faker->email)
                ->type('password', '123456')
                ->type('password_confirmation', $faker->password(6, 10))
                ->click('#submit-button')
                //Address form
                ->assertSee('Register Address')
                ->select('country-address', $country)
                ->assertSelected('country-address', $country)
                ->type('#label', 'Default Address')
                ->type('owner_name', $faker->firstName)
                ->type('owner_surname', $faker->lastName)
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
                ->pause(5000)
                ->waitForLocation('/login');

        });
    }

    /**
     * @group user
     * @group CRUDS
     */
    public function testEditUser()
    {
        $this->browse(function (Browser $browser) {
            $user = User::first();
            $browser->loginAs($user)
                ->visit($this->prefixUrl.$user->id)
                ->click('#optionsDropdown')
                ->click('#edit')
                ->waitForLocation($this->prefixUrl.$user->id.'/edit')
                ->type('surname', 'Duarte')
                ->click('#save')
                ->waitForLocation($this->prefixUrl.$user->id);
        });
    }


    /**
     * @group user
     * @group CRUDS
     */
    public function testDeleteUser()
    {
        $this->browse(function (Browser $browser) {
            $user = User::all()->last();
            $browser->loginAs($user)
                ->visit($this->prefixUrl.$user->id)
                ->click('#optionsDropdown')
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
                ->waitForLocation($this->prefixUrl.$user->id);
        });
    }


}
