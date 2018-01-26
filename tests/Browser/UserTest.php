<?php

namespace Tests\Browser;

use App\Admin;
use Illuminate\Foundation\Auth\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
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

        try {
            $this->browse(function (Browser $browser) {
                $faker = \Faker\Factory::create();
                $password = $faker->password(6, 10);
                $browser->visit(route('register.create'))

                    ->type('client[name]', $faker->firstName)
                    ->click('#next_btn')
                    ->assertRouteIs('register.create')

                    ->type('phones[0][number]', 9999999988)
                    ->click('#next_btn')
                    ->assertRouteIs('register.wizard')

                    ->type('client[name]', $faker->firstName)
                    ->click('#next_btn')
                    ->assertRouteIs('register.wizard')

                    ->type('client[surname]', $faker->lastName)
                    ->click('#next_btn')
                    ->assertRouteIs('register.wizard')

                    ->type('client[identity_document]', '0000.000')
                    ->click('#next_btn')
                    ->assertRouteIs('register.wizard')

                    ->type('client[tax_document]', '000.000.000-00')
                    ->click('#next_btn')
                    ->assertRouteIs('register.wizard')

                    ->type('user[email]', 'a')
                    ->click('#next_btn')
                    ->assertRouteIs('register.wizard')

                    ->type('user[email]', $faker->email)
                    ->click('#next_btn')
                    ->assertRouteIs('register.wizard')

                    ->type('user[email]', 'cdjohnnatha@gmail.com')
                    ->click('#next_btn')
                    ->assertRouteIs('register.wizard')

                    ->type('user[password]', $faker->password(6))
                    ->type('user[password_confirmation]', $password)
                    ->assertRouteIs('register.wizard')
                    ->click('#next_btn')

                    ->type('user[password]', $password)
                    ->type('user[password_confirmation]', $password)
                    ->assertRouteIs('register.wizard')
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
                    ->pause(800)
                    ->click('#next_btn')
                    ->attach('identification_card', '/home/claudio/Pictures/package_1.jpg')
                    ->attach('usps_form', '/home/claudio/Pictures/package_1.jpg')
                    ->attach('proof_address', '/home/claudio/Pictures/package_1.jpg')
                    ->click('#register_btn')
                    ->waitForLocation('/login');
            });
        } catch (\Exception $e) {
        } catch (\Throwable $e) {
        }
    }

    /**
     * @group userRegisterAdmin
     * @group CRUDS
     */
    public function testRegisterByAdm()
    {
        $this->browse(function (Browser $browser) {
            $faker = \Faker\Factory::create();
            $password = $faker->password(6, 10);
            $browser->loginAs(Admin::first(), 'admin')
                ->visit(route('admin.users.create'))
//                ->press('.planSection')
                ->type('user[name]', $faker->firstName)
                ->type('user[surname]', $faker->lastName)
                ->type('user[rg]', '0000.000')
                ->type('user[cpf]', '000.000.000-00')
                ->type('user[phone]', 83998000802)
                ->type('user[email]', $faker->email)
                ->type('user[password]', $password)
                ->type('user[password_confirmation]', $password)
                ->driver->executeScript('window.scrollTo(0, 700);');
            $browser
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
                ->pause(5000)
                ->driver->executeScript('window.scrollTo(0, 700);');
            $browser
                ->click('#next_btn')
                ->click('#submit-button')
                ->waitForLocation('/');
        });
    }

    /**
     * @group userEdit
     * @group CRUDS
     */
//    public function testEditUser()
//    {
//        $this->browse(function (Browser $browser) {
//            $user = User::first();
//            $browser->loginAs($user)
//                ->visit($this->prefixUrl.'dashboard')
//                ->click('#optionsDropdown')
//                ->click('#edit')
//                ->waitForLocation($this->prefixUrl.$user->id.'/edit')
//                ->type('surname', 'Duarte')
//                ->click('#save')
//                ->waitForLocation($this->prefixUrl.$user->id);
//        });
//    }


    /**
     * @group user
     * @group CRUDS
     * @group deleteUser
     */
//    public function testDeleteUser()
//    {
//        $this->browse(function (Browser $browser) {
//            $user = User::all()->last();
//            $browser->loginAs($user)
//                ->visit($this->prefixUrl.'dashboard')
//                ->click('#optionsDropdown')
//                ->click('#delete')
//                ->waitForLocation('/');
//        });
//    }

    /**
     * @group userLogin
     */
    public function testLogin()
    {
        $this->browse(function (Browser $browser) {
            $user = User::find(1);
            $browser->visit('/login')
                ->assertSee('Login')
                ->type('#inputInlineUsername', 'holyship@user.com')
                ->type('#inputInlinePassword', 'holyship123')
                ->press('#submit')
                ->waitForLocation($this->prefixUrl.'dashboard');
        });
    }

}