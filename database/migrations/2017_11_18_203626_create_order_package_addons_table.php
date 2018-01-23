<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrderPackageAddonsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order_package_addons', function (Blueprint $table) {
            $table->increments('id');
            $table->decimal('price');
            $table->integer('order_package_id');
            $table->integer('company_warehouse_addon_id');

            $table->index('order_package_id');
            $table->index('company_warehouse_addon_id');

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
        Schema::dropIfExists('order_package_addons');
    }
}
