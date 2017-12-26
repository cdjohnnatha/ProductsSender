<?php

namespace Tests\Browser;

use App\Entities\User;
use Tests\DuskTestCase;
use Laravel\Dusk\Browser;

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
            $user = User::where('type','user')->first();
            $faker = \Faker\Factory::create();
            $browser->loginAs($user)
                ->visit(route('user.packages.create'))
                ->type('package[provider]', $faker->company)
                ->type('package[addressee]', $faker->name)
                ->type('package[track_number]', $faker->randomNumber(8))
                ->type('package[description]', $faker->words)
                ->driver->executeScript('window.scrollTo(0, 600);');
            $browser
                ->type('custom_clearance[0][description]', $faker->words)
                ->type('custom_clearance[0][quantity]', $faker->numberBetween(1, 10))
                ->type('custom_clearance[0][unit_price]', $faker->randomFloat(2, 1, 10))
                ->click('#add_custom_clearance_button')
                ->type('custom_clearance[1][description]', $faker->words)
                ->type('custom_clearance[1][quantity]', $faker->numberBetween(1, 10))
                ->type('custom_clearance[1][unit_price]', $faker->randomFloat(2, 1, 10))
                ->driver->executeScript('window.scrollTo(0, 600);');
            $browser
                ->press('#submit-button')
                ->waitForLocation('/user/packages/wizard')
                ->driver->executeScript('window.scrollTo(0, 600);');
            $browser
                ->press('#submit-button')
                ->waitForLocation('/user/packages');
        });
    }
}
