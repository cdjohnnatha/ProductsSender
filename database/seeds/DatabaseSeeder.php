<?php

use App\Entities\Company\Company;
use App\Entities\Company\CompanyAddons;
use App\Entities\Company\CompanyAddress;
use App\Entities\Company\CompanyPhone;
use App\Entities\Company\Warehouse\CompanyWarehouse;
use App\Entities\Company\Warehouse\CompanyWarehouseAddress;
use App\Entities\Company\Warehouse\CompanyWarehousePhones;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call('UsersTableSeeder');
        $this->call('StatusTableSeeder');


        factory(Company::class, 2)->create()->each(function($company) {
            factory(CompanyPhone::class, 3)->create(['company_id' => $company->id]);
            factory(CompanyAddress::class, 1)->create(['company_id' => $company->id]);
            factory(CompanyAddons::class, 1)->create(['company_id' => $company->id]);

            factory(CompanyWarehouse::class, 1)->create(['company_id' => $company->id])->each(function($warehouse) {
//                factory(CompanyWarehouseAddress::class, 1)->create(['company_warehouse_id' => $warehouse->id]);
                factory(CompanyWarehousePhones::class, 3)->create(['company_warehouse_id' => $warehouse->id]);
            });
        });

        DB::table('company_warehouse_addresses')->insert([
            'country' => 'USA',
            'street' => '6th St.',
            'street2' => '',
            'city' => 'Melbourne',
            'state' => 'FL',
            'postal_code' => '32904',
            'number' => '123',
            'formatted_address' => '123 6th St. Melbourne, FL 32904',
            'company_warehouse_id' => 1
        ]);

        DB::table('company_warehouse_addresses')->insert([
            'country' => 'USA',
            'street' => '44 Shirley Ave.',
            'street2' => '',
            'city' => 'West Chicago',
            'state' => 'IL',
            'postal_code' => '60185',
            'number' => '44',
            'formatted_address' => '44 Shirley Ave. West Chicago, IL 60185',
            'company_warehouse_id' => 2
        ]);

        DB::table('company_warehouse_addons')->insert([
            'company_warehouse_id' => 1,
            'company_addons_id' => 1,
            'price' => 1.35
        ]);

        DB::table('company_warehouse_addons')->insert([
            'company_warehouse_id' => 1,
            'company_addons_id' => 1,
            'price' => 2.00
        ]);

        DB::table('company_warehouse_addons')->insert([
            'company_warehouse_id' => 2,
            'company_addons_id' => 2,
            'price' => 2.35
        ]);

        DB::table('company_warehouse_addons')->insert([
            'company_warehouse_id' => 2,
            'company_addons_id' => 2,
            'price' => 3.00
        ]);

        DB::table('fee_weight_rules')->insert([
            'initial_fee' => 1,
            'max_weight_fee' => 2,
            'overweight_fee' => 2.4,
            'company_warehouse_id' => 1
        ]);

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
        ]);




    }
}
