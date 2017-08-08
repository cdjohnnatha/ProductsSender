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
            'name' => 'Holyship',
            'surname' => 'User',
            'email' => 'holyship@user.com',
            'country' => 'Brasil',
            'phone' => '08000800',
            'password' => Hash::make('holyship123'),
            'subscription_id' => 1
        ]);
//        factory(App\User::class, 10)->create();
    }
}
