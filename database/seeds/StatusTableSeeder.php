<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StatusTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     * @group startup
     * @return void
     */
    public function run()
    {
        DB::table('status')->insert([
            'status' => 'WAITING',
        ]);
        DB::table('status')->insert([
            'status' => 'QUEUED',
        ]);
        DB::table('status')->insert([
            'status' => 'SUCCESS',
        ]);
        DB::table('status')->insert([
            'status' => 'ERROR',
        ]);
        DB::table('status')->insert([
            'status' => 'REFUNDED',
        ]);
        DB::table('status')->insert([
            'status' => 'REFUNDPENDING',
        ]);
        DB::table('status')->insert([
            'status' => 'REFUNDREJECTED',
        ]);
        DB::table('status')->insert([
            'status' => 'WAREHOUSE',
        ]);

        DB::table('status')->insert([
            'status' => 'WAREHOUSE_READY',
        ]);

        DB::table('status')->insert([
            'status' => 'WAREHOUSE_SENT',
        ]);

        DB::table('status')->insert([
            'status' => 'WAREHOUSE_WAITING',
        ]);

        DB::table('status')->insert([
            'status' => 'WAREHOUSE_WAITING_USER',
        ]);

        DB::table('status')->insert([
            'status' => 'WAREHOUSE_NOTIFY_USER',
        ]);



    }

}
