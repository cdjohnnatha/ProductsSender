<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCompanyWarehouseAddonsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('company_warehouse_addons', function (Blueprint $table) {
            $table->increments('id');
            $table->decimal('price');
            $table->integer('company_warehouse_id');
            $table->integer('company_addon_id');

            $table->index('company_warehouse_id');
            $table->index('company_addon_id');
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
        Schema::dropIfExists('company_warehouse_addons');
    }
}
