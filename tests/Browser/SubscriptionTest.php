<?php

namespace Tests\Browser;

use App\Admin;
use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class SubscriptionTest extends DuskTestCase
{

    /**
     * @group subscription
     */
    public function testClickNewSubscription()
    {
        $this->browse(function (Browser $browser) {
            $admin = Admin::find(1);
            $browser->loginAs($admin, 'admin')
                ->visit('/admin/dashboard')
                ->click('#btn-subscription')
                ->click('#create-subscription')
                ->waitForLocation('/admin/subscriptions/create')
                ->assertSee('Subscriptions')
                ->pause(3000);

        });
    }

    /**
     * @group subscription
     */
    public function testClickListSubscription()
    {
        $this->browse(function (Browser $browser) {
            $admin = Admin::find(1);
            $browser->loginAs($admin, 'admin')
                ->visit('/admin/dashboard')
                ->click('#btn-subscription')
                ->click('#list-subscriptions')
                ->waitForLocation('/admin/subscriptions/show-list');
        });
    }

    /**
     * @group subscriptions
     */
    public function testRegisterSubscription()
    {
        $this->browse(function (Browser $browser) {
            $admin = Admin::find(1);
            $faker = \Faker\Factory::create();
            $country = $faker->country;
            $browser->loginAs($admin, 'admin')
                ->visit('/admin/subscriptions/create')
                ->type('title', $faker->title)
                ->type('amount', $faker->numberBetween(0, 60))
                ->press('#addBenefit')
                ->press('#addBenefit')
                ->waitFor('#benefit-2', 3)
                ->type('benefit-0', $faker->word)
                ->type('benefit-1', $faker->word)
                ->type('benefit-2', $faker->word)
                ->press('#submit-button')
                ->waitForLocation('/admin/subscriptions/show-list');

        });
    }
}
