<?php

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
        factory(\App\Company::class, 10)->create()->each(function($company) {
            factory(\App\CompanyPhone::class, 3)->create(['company_id' => $company->id]);
            factory(\App\CompanyAddress::class, 1)->create(['company_id' => $company->id]);
            factory(\App\CompanyAddons::class, 1)->create(['company_id' => $company->id]);

            factory(\App\CompanyWarehouse::class, 1)->create(['company_id' => $company->id])->each(function($warehouse) {
                factory(\App\CompanyWarehouseAddress::class, 1)->create(['company_warehouse_id' => $warehouse->id]);
                factory(\App\CompanyWarehousePhones::class, 3)->create(['company_warehouse_id' => $warehouse->id]);
            });
        });

        $this->call('StatusTableSeeder');


    }
}
