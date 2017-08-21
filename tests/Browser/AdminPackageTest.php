<?php

namespace Tests\Browser;

use App\Admin;
use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class AdminPackageTest extends DuskTestCase
{
    /**
     * @group packages
     * @return void
     */
    public function testRegisterPackage()
    {
        $this->browse(function (Browser $browser) {
            $faker = \Faker\Factory::create();
            $browser->loginAs(Admin::find(4), 'admin')
                ->visit(route('admin.packages.create'))
                ->select('warehouse_id', 2)
                ->mouseover('.withripple')
                ->select('.withripple', 2)
                ->type('package[object_owner]', 1)
                ->select('status[status_id]')
                ->type('package[weight]', $faker->randomFloat(2, 1, 5))
                ->type('package[width]', $faker->randomFloat(2, 1, 5))
                ->type('package[depth]', $faker->randomFloat(2, 1, 5))
                ->type('package[height]', $faker->randomFloat(2, 1, 5))
                ->type('package[quote]', $faker->words)
                ->attach('package_files[]', '/home/claudio/Pictures/full-1.jpg')
                ->pause(1000)
                ->press('#submit-button')
                ->pause(2000);
        });
    }
}
