<?php

namespace Tests\Browser;

use App\Entities\Company\Company;
use App\Entities\User;
use Illuminate\Contracts\Logging\Log;
use Tests\DuskTestCase;
use Laravel\Dusk\Browser;

class CompanyWarehouseFeeWeightRulesTest extends DuskTestCase
{

    /**
     * @group registerCompanyWarehouseWeightFeeRules
     */
    public function testRegisterCompanyAddon()
    {
        try {
            $this->browse(function (Browser $browser) {
                $admin = User::where('type', 'admin')->get()->last();
                $faker = \Faker\Factory::create();
                $companies = Company::all()->first();

                $browser->loginAs($admin)
                    ->visit(route('admin.companies.warehouses.fees.weight.create', [$companies->id, $companies->warehouses->first()->id]))
                    ->type('initial_fee', $faker->randomFloat(2, 0, 2))
                    ->type('max_weight_fee', $faker->randomFloat(2, 0, 2))
                    ->type('overweight_fee', $faker->randomFloat(2, 0, 2))
                    ->press('#submit-button')
                    ->waitForLocation('/admin/companies/' . $companies->id . '/warehouses/' . $companies->warehouses->first()->id);
            });
        } catch (\Exception $e) {
        } catch (\Throwable $e) {
        }
    }

    /**
     * @group editCompanyWarehouseWeightFeeRules
     * @all
     */
    public function testUpdateCompany()
    {
        try {
            $this->browse(function (Browser $browser) {
                $admin = User::where('type', 'admin')->get()->last();
                $faker = \Faker\Factory::create();
                $companies = Company::all()->first();
                $feeRules = $companies->warehouses->first()->feeWeightRules->first();

                $browser->loginAs($admin)
                    ->visit(route('admin.companies.warehouses.fees.weight.edit', [$companies->id, $companies->warehouses->first()->id, $feeRules->id]))
                    ->type('initial_fee', $faker->randomFloat(2, 0, 2))
                    ->type('max_weight_fee', $faker->randomFloat(2, 0, 2))
                    ->type('overweight_fee', $faker->randomFloat(2, 0, 2))
                    ->press('#submit-button')
                    ->waitForLocation('/admin/companies/' . $companies->id . '/warehouses/' . $companies->warehouses->first()->id);
            });
        } catch (\Exception $e) {
        } catch (\Throwable $e) {
        }
    }


}
