<?php

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class WarehouseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('company_warehouse_addresses')->insert([
            'country' => 'USA',
            'street' => '6th St.',
            'street2' => '',
            'city' => 'Melbourne',
            'state' => 'FL',
            'postal_code' => '32904',
            'number' => '123',
            'formatted_address' => '123 6th St. Melbourne, FL 32904',
            'company_warehouse_id' => 1,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
        ]);


        DB::table('company_warehouse_addons')->insert([
            'company_warehouse_id' => 1,
            'company_addons_id' => 1,
            'price' => 1.35,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
        ]);

        DB::table('company_warehouse_addons')->insert([
            'company_warehouse_id' => 1,
            'company_addons_id' => 1,
            'price' => 2.00,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
        ]);

        DB::table('fee_weight_rules')->insert([
            'max_weight_fee' => 2,
            'overweight_fee' => 2.4,
            'company_warehouse_id' => 1,
            'max_weight' => 200.00,
            'overweight' => 100.00,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
        ]);



        DB::table('company_warehouse_fee_rules')->insert([
            'fee_rules_id' => 1,
            'company_warehouse_id' => 1,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
        ]);

    }
}
