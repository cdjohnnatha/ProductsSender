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
        factory(Company::class, 2)->create()->each(function($company) {
            factory(CompanyPhone::class, 3)->create(['company_id' => $company->id]);
            factory(CompanyAddress::class, 1)->create(['company_id' => $company->id]);
            factory(CompanyAddons::class, 1)->create(['company_id' => $company->id]);

            factory(CompanyWarehouse::class, 1)->create(['company_id' => $company->id])->each(function($warehouse) {
                factory(CompanyWarehousePhones::class, 3)->create(['company_warehouse_id' => $warehouse->id]);
            });
        });

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
