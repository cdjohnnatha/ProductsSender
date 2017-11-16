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
        DB::table('admins')->insert([
            'name' => 'Holyship',
            'surname' => 'Team',
            'email' => 'holyship@admin.com',
            'phone' => '08000800',
            'password' => Hash::make('holyship123'),
            'default_warehouse' => 1
        ]);
    }
}
