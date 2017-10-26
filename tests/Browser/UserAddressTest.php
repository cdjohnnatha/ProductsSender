<?php

namespace Tests\Browser;

use App\User;
use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class UserAddressTest extends DuskTestCase
{
    /**
     * @group addressCrud
     */
    public function testCreateNewAddress()
    {
        $this->browse(function (Browser $browser) {
            $user = User::find(1);
            $faker = \Faker\Factory::create();
            $browser->loginAs($user,'web')
                ->visit(route('user.address.create', $user->id))
                ->type('address[label]', $faker->name)
                ->type('address[owner_name]', $faker->firstName)
                ->type('address[owner_surname]', $faker->lastName)
                ->type('address[phone]', $faker->phoneNumber)
                ->type('address[company_name]', $faker->company)
                ->type('address[number]', $faker->phoneNumber)
                ->type('address[postal_code]', $faker->postcode)
                ->type('#map', 'Rua rita porfirio chaves')
                ->waitFor('.pac-item')
                ->click('.pac-item')
                ->pause(3000)
                ->click('#submit-button');
        });
    }
}
