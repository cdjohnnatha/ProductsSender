<?php

use Illuminate\Database\Seeder;

class AdminTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'type' => 'admin',
            'email' => 'holyship@admin.com',
            'password' => Hash::make('holyship123'),
        ]);
    }
}
