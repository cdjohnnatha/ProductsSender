<?php

use Illuminate\Database\Seeder;

class StartupTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call('AdminTableSeeder');
        $this->call('UsersTableSeeder');
        $this->call('DatabaseSeeder');
        $this->call('StatusTableSeeder');

    }
}
