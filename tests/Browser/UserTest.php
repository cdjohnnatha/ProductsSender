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
            $browser->visit(route('register.create'))
                ->press('.planSection')
                ->type('user[name]', $faker->firstName)
                ->type('user[surname]', $faker->lastName)
                ->type('user[rg]', '0000.000')
                ->type('user[cpf]', '000.000.000-00')
                ->type('user[phone]', 83998000802)
                ->type('user[email]', $faker->email)
                ->type('user[password]', $password)
                ->type('user[password_confirmation]', $password)
                ->click('#next_btn')
                ->type('address[label]', $faker->name)
                ->type('address[owner_name]', $faker->firstName)
                ->type('address[owner_surname]', $faker->lastName)
                ->type('address[phone]', $faker->phoneNumber)
                ->type('address[company_name]', $faker->company)
                ->type('address[number]', $faker->buildingNumber)
                ->type('address[postal_code]', $faker->postcode)
                ->type('#map', 'Rua rita porfirio chaves')
                ->waitFor('.pac-item')
                ->click('.pac-item')
                ->pause(400)
                ->click('#next_btn')
                ->click('#submit-button')
                ->pause(4000);
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
