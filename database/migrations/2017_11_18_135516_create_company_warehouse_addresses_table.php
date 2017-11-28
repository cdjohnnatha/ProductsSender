<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCompanyWarehouseAddressesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('company_warehouse_addresses', function (Blueprint $table) {
            $table->increments('id');
            $table->string('country', 50);
            $table->string('street', 100);
            $table->string('street2', 100)->nullable();
            $table->string('city', 50);
            $table->string('state', 50);
            $table->string('postal_code', 20);
            $table->string('number', 15);
            $table->string('formatted_address', 200);
            $table->integer('company_warehouse_id');

            $table->index('company_warehouse_id');
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
        Schema::dropIfExists('warehouse_addresses');
    }
}
