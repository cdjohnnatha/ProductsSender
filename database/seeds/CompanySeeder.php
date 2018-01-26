<?php

use App\Entities\Company\Company;
use App\Entities\Company\CompanyAddons;
use App\Entities\Company\CompanyAddress;
use App\Entities\Company\CompanyPhone;
use App\Entities\Company\Warehouse\CompanyWarehouse;
use App\Entities\Company\Warehouse\CompanyWarehousePhones;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CompanySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('companies')->insert([
            'name' => 'Holyship'
        ]);

        DB::table('company_phones')->insert([
           'number' => '99999999',
            'company_id' => 1
        ]);

        DB::table('company_warehouses')->insert([
           'name' => 'Main Warehouse',
            'storage_time' => 15,
            'box_price' => 1.65,
            'company_id' => 1
        ]);

        DB::table('company_addresses')->insert([
            'country' => 'BR',
            'street' => 'aaa',
            'street2' => 'bbb',
            'city' => 'Chicago',
            'state' => 'FL',
            'postal_code' => '12345',
            'number' => '11',
            'formatted_address' => 'aaa bbb',
            'company_id' => 1
        ]);

        DB::table('fee_rules')->insert([
            'title' => 'Fast pack',
            'amount' => 2.00,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
        ]);

        DB::table('fee_rules')->insert([
            'title' => 'Fast pack',
            'amount' => 3.00,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
        ]);
    }
}
