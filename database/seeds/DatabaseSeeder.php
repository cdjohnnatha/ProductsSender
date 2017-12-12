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


        factory(Company::class, 10)->create()->each(function($company) {
            factory(CompanyPhone::class, 3)->create(['company_id' => $company->id]);
            factory(CompanyAddress::class, 1)->create(['company_id' => $company->id]);
            factory(CompanyAddons::class, 1)->create(['company_id' => $company->id]);

            factory(CompanyWarehouse::class, 1)->create(['company_id' => $company->id])->each(function($warehouse) {
                factory(CompanyWarehouseAddress::class, 1)->create(['company_warehouse_id' => $warehouse->id]);
                factory(CompanyWarehousePhones::class, 3)->create(['company_warehouse_id' => $warehouse->id]);
            });
        });
    }
}
