<?php

namespace Tests\Browser;

use App\Admin;
use App\Subscription;
use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class SubscriptionTest extends DuskTestCase
{

    /**
     * @group subscriptions
     * @group subscriptionsRegister
     */
    public function testRegisterSubscription()
    {
        $this->browse(function (Browser $browser) {
            $admin = Admin::find(1);
            $faker = \Faker\Factory::create();
            $browser->loginAs($admin, 'admin')
                ->visit(route('admin.subscriptions.create'))
                ->type('subscription[title]', $faker->word)
                ->type('subscription[amount]', $faker->randomFloat(2, 1, 2))
                ->type('subscription[discounts]', $faker->randomFloat(2, 1, 5))
                ->type('subscription[slots]', $faker->randomNumber())
                ->press('.toggle')
                ->type('#benefit-0', $faker->words)
                ->type('#benefit-1', $faker->words)
                ->type('#benefit-2', $faker->words)
                ->type('#benefit-3', $faker->words)
                ->type('#benefit-4', $faker->words)
                ->type('#benefit-5', $faker->words)
                ->click('.check')
                ->press('#submit-button')
                ->pause(5000)
                ->waitForLocation('/admin/subscriptions');

        });
    }

    /**
     * @group subscriptions
     */
    public function testEditSubscription()
    {
        $this->browse(function (Browser $browser) {
            $admin = Admin::find(1);
            $faker = \Faker\Factory::create();
            $edit = Subscription::orderBy('id', 'desc')->first();
            $browser->loginAs($admin, 'admin')
                ->visit(route('admin.subscriptions.edit', $edit->id))
                ->type('subscription[title]', $faker->word)
                ->type('subscription[amount]', $faker->randomFloat(2, 1, 5))
                ->type('subscription[discounts]', $faker->randomFloat(2, 1, 5))
                ->type('subscription[slots]', $faker->randomNumber())
                ->press('.toggle')
                ->type('#benefit-0', $faker->words)
                ->type('#benefit-1', $faker->words)
                ->type('#benefit-2', $faker->words)
                ->type('#benefit-3', $faker->words)
                ->type('#benefit-4', $faker->words)
                ->type('#benefit-5', $faker->words)
                ->press('#submit-button')
                ->waitForLocation('/admin/subscriptions');
        });
    }

    /**
     * @group subscriptionsDelete
     * @group subscriptions
     */
    public function testDeleteSubscription()
    {
        $this->browse(function (Browser $browser) {
            $admin = Admin::all();
            $admin = $admin[1];
            $delete = Subscription::orderBy('id', 'desc')->first();
            $browser->loginAs($admin, 'admin')
                ->visit(route('admin.subscriptions.index'))
                ->press('#delete-button-'.$delete->id)
                ->press('.swal2-confirm')
                ->waitFor('.swal2-confirm')
                ->press('.swal2-confirm')
                ->waitForLocation('/admin/subscriptions');

        });
    }
}
