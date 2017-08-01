<?php

namespace Tests\Browser;

use App\User;
use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class UserInterfaceTest extends DuskTestCase
{
    private $prefixUrl = '/user/';
    /**
     * @group userInterface
     */
    public function testUserHome()
    {
        $this->browse(function (Browser $browser) {
            $user = User::first();
            $browser->loginAs($user)
                ->visit($this->prefixUrl.$user->id)
                ->assertPathIs($this->prefixUrl.$user->id);
        });
    }

    /**
     * @group userInterface
     */
    public function testClickNewPackage()
    {
        $this->browse(function (Browser $browser) {
            $user = User::first();
            $browser->loginAs($user)
                ->visit($this->prefixUrl.$user->id)
                ->click('#packagesLabel')
                ->click('#new-one')
                ->assertPathIs($this->prefixUrl.$user->id.'/packages/inform');
        });
    }

    /**
     * @group userInterface
     */
//    public function testClickSelectPackage()
//    {
//        $this->browse(function (Browser $browser) {
//            $user = User::first();
//            $browser->loginAs($user)
//                ->visit($this->prefixUrl.$user->id)
//                ->click('#packagesLabel')
//                ->click('#create-one')
//                ->assertPathIs($this->prefixUrl.$user->id.'/packages/create');
//        });
//    }

    /**
     * @group userInterface
     */
//    public function testClickJoinPackage()
//    {
//        $this->browse(function (Browser $browser) {
//            $user = User::first();
//            $browser->loginAs($user)
//                ->visit($this->prefixUrl.$user->id)
//                ->click('#packagesLabel')
//                ->click('#join-many')
//                ->assertPathIs($this->prefixUrl.$user->id.'/packages/join');
//        });
//    }

}
