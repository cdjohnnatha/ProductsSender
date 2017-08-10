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
     */
    public function testRegisterSubscription()
    {
        $this->browse(function (Browser $browser) {
            $admin = Admin::find(1);
            $faker = \Faker\Factory::create();
            $country = $faker->country;
            $browser->loginAs($admin, 'admin')
                ->visit(route('admin.subscriptions.create'))
                ->type('subscription[title]', $faker->word)
                ->type('subscription[amount]', $faker->randomFloat(2, 1, 10))
                ->type('#input-message-0', $faker->word)
                ->press('#addMessage')
                ->type('#input-message-1', $faker->word)
                ->press('#addMessage')
                ->type('#input-message-2', $faker->word)
                ->press('#submit-button')
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
            $country = $faker->country;
            $edit = Subscription::orderBy('id', 'desc')->first();
            $browser->loginAs($admin, 'admin')
                ->visit(route('admin.subscriptions.edit', $edit->id))
                ->type('subscription[title]', $faker->word)
                ->type('subscription[amount]', $faker->randomFloat(2, 1, 10))
                ->type('#input-message-0', $faker->word)
                ->type('#input-message-1', $faker->word)
                ->type('#input-message-2', $faker->word)
                ->press('#submit-button')
                ->waitForLocation('/admin/subscriptions');
        });
    }

    /**
     * @group subscriptions
     */
    public function testDeleteSubscription()
    {
        $this->browse(function (Browser $browser) {
            $admin = Admin::find(1);
            $delete = Subscription::orderBy('id', 'desc')->first();
            $browser->loginAs($admin, 'admin')
                ->visit(route('admin.subscriptions.index'))
                ->press('#delete-'.$delete->id)
                ->waitForLocation('/admin/subscriptions');

        });
    }
}
