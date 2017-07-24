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
            'name' => 'Claudio',
            'surname' => 'Djohnnatha',
            'email' => 'claudio@admin.com',
            'country' => 'Brasil',
            'phone' => '8398000802',
            'password' => Hash::make('123456'),
            'default_warehouse_id' => 1
        ]);
    }
}
