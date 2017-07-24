<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        DB::table('users')->insert([
            'name' => 'Claudio',
            'surname' => 'Djohnnatha',
            'email' => 'claudio@example.com',
            'country' => 'Brasil',
            'phone' => '98000802',
            'password' => Hash::make('123456'),
            'subscription_id' => 1
        ]);
        factory(App\User::class, 10)->create();
    }
}
