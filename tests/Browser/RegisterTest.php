<?php

namespace Tests\Browser;

use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Faker\Factory as Faker;

class RegisterTest extends DuskTestCase
{
    /**
     * A Dusk test example.
     *
     * @return void
     */
    public function testRegister()
    {

        $this->browse(function (Browser $browser) {
            $faker = Faker::create();
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

}
