<?php

namespace Tests\Browser;

use Illuminate\Foundation\Auth\User;
use Tests\DuskTestCase;
use Laravel\Dusk\Browser;

class UserTest extends DuskTestCase
{
    /**
     * A Dusk test example.
     *
     * @return void
     */
    public function testDashboard()
    {
        $this->browse(function (Browser $browser) {
            $user = User::find(1);
            $browser->loginAs($user)
                ->visit('/home/'.$user->id)
                ->waitForText('Dashboard');

        });
    }

//    public function testEditUser()
//    {
//        $this->browse(function (Browser $browser) {
//            $user = User::find(1);
//            $browser->loginAs($user)
//                ->visit('/home/'.$user->id)
//                ->click('.dropdown')
//                ->click('#edit')
//                ->waitForLocation('/home/'.$user->id.'/edit')
//                ->type('surname', 'Duarte')
//                ->click('#save')
//                ->waitForLocation('/home/'.$user->id);
//        });
//    }

//    public function testDeleteUser()
//    {
//        $this->browse(function (Browser $browser) {
//            $user = factory(\App\User::class)->create();
//            $browser->loginAs($user)
//                ->visit('/home/'.$user->id)
//                ->click('.dropdown')
//                ->click('#delete')
//                ->waitForLocation('/');
//        });
//    }


}
