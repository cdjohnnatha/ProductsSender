<?php

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PackageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('packages')->insert([
            'store_name' => 'armazem',
            'content_type' => 'MERCHANDISE',
            'width' => '20.0',
            'height' => '20.0',
            'depth' => '20.0',
            'unit_measure' => 'cm',
            'weight' => '2',
            'weight_measure' => 'kg',
            'total_goods' => '100',
            'note' => '100',
            'description' => 'testing testing',
            'client_id' => 1,
            'package_status_id' => 2,
            'company_warehouse_id' => 1,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
        ]);

        DB::table('package_goods_declarations')->insert([
            'description' => 'Headphones',
            'quantity' => 5,
            'unit_price' => 20.00,
            'total_unit' => 100.00,
            'mass_unit' => 'g',
            'net_weight' => '300',
            'package_id' => 1
        ]);
    }
}
