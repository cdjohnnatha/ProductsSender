<?php

namespace Tests\Browser;

use App\User;
use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class IncomingPackageTest extends DuskTestCase
{
    /**
     * @group incomingPackage
     * @group registerIncomingPackage
     * @return void
     */
    public function testRegisterIncomingPackage()
    {
        $this->browse(function (Browser $browser) {
            $user = User::first();
            $faker = \Faker\Factory::create();
            $browser->loginAs($user)
                ->visit(route('user.incoming.create'))
                ->type('incoming[provider]', $faker->company)
                ->type('incoming[addressee]', $faker->name)
                ->type('incoming[track_number]', $faker->randomNumber(8))
                ->type('incoming[description]', $faker->words)
                ->pressAndWaitFor('#next_button', 1)
                ->type('custom_clearance[0][description]', $faker->words)
                ->type('custom_clearance[0][quantity]', $faker->numberBetween(1, 1000))
                ->type('custom_clearance[0][unit_price]', $faker->randomFloat(2, 1, 10))
                ->click('#add_custom_clearance_button')
                ->type('custom_clearance[1][description]', $faker->words)
                ->type('custom_clearance[1][quantity]', $faker->numberBetween(1, 1000))
                ->type('custom_clearance[1][unit_price]', $faker->randomFloat(2, 1, 10))
                ->pressAndWaitFor('#next_button', 1)
                ->click('.check')
                ->pause(2000)
                ->press('#submit-button')
                ->pause(7000);
        });
    }
}
