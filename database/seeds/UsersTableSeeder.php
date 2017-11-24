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
            'type' => 'user',
            'email' => 'holyship@user.com',
            'password' => Hash::make('holyship123')
        ]);

        DB::table('users')->insert([
            'type' => 'admin',
            'email' => 'holyship@admin.com',
            'password' => Hash::make('holyship123'),
        ]);
    }

}
