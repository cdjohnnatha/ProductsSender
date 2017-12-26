<?php

use Illuminate\Database\Seeder;

class StatusTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('package_status')->insert([
            'message' => 'INCOMING',
        ]);
        DB::table('package_status')->insert([
            'message' => 'REGISTERED',
        ]);

        DB::table('package_status')->insert([
            'message' => 'PREPARING',
        ]);

        DB::table('package_status')->insert([
            'message' => 'SENT',
        ]);

        DB::table('order_status')->insert([
           'message' => 'WAITING_PAYMENT'
        ]);

        DB::table('order_status')->insert([
           'message' => 'PAIED'
        ]);


    }
}
