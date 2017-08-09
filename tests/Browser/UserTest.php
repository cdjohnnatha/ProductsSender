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
            $password = $faker->password(6, 10);
            $browser->visit('/register')
                ->type('users[name]', $faker->firstName)
                ->type('users[surname]', $faker->lastName)
                ->type('users[phone]', 83998000802)
                ->type('users[email]', $faker->email)
                ->type('users[country]', $country)
                ->type('users[password]', $password)
                ->type('users[password_confirmation]', $password)
                ->click('#section-button')
                //Address form
                ->assertSee('Address')
                ->type('#label-name', 'Default Address')
                ->type('owner_name', $faker->firstName)
                ->type('owner_surname', $faker->lastName)
                ->type('phone', $faker->phoneNumber)
                ->type('company_name', $faker->company)
                ->type('address', $faker->streetAddress)
                ->type('#city', $faker->streetName)
                ->type('state', $faker->streetSuffix)
                ->type('postal_code', $faker->postcode)
                ->click('#submit-button')
                ->assertPathIsNot('/register');
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
