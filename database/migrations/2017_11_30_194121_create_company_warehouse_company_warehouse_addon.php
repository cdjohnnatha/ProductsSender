<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCompanyWarehouseCompanyWarehouseAddon extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('company_warehouse_company_warehouse_addon', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('company_warehouse_id');
            $table->integer('company_warehouse_addon_id');

            $table->index('company_warehouse_id', 'cwindex');
            $table->index('company_warehouse_addon_id', 'cwaindex');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('company_warehouse_company_warehouse_addon');

    }
}
