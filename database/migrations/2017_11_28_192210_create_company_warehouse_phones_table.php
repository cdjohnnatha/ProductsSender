<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCompanyWarehousePhonesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('company_warehouse_phones', function (Blueprint $table) {
            $table->increments('id');
            $table->string('number', 30);
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
        Schema::dropIfExists('company_warehouse_phones');
    }
}
