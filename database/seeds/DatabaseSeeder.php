<?php

use App\Entities\Company\Company;
use App\Entities\Company\CompanyAddons;
use App\Entities\Company\CompanyAddress;
use App\Entities\Company\CompanyPhone;
use App\Entities\Company\Warehouse\CompanyWarehouse;
use App\Entities\Company\Warehouse\CompanyWarehouseAddress;
use App\Entities\Company\Warehouse\CompanyWarehousePhones;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        $this->call('UsersTableSeeder');
        $this->call('StatusTableSeeder');
        $this->call('CompanySeeder');
        $this->call('WarehouseSeeder');
        $this->call('PackageSeeder');
    }
}
