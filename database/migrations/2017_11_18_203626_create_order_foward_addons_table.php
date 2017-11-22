<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrderFowardAddonsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order_foward_addons', function (Blueprint $table) {
            $table->increments('id');
            $table->decimal('price');
            $table->integer('order_foward_id');
            $table->integer('company_addon_id');

            $table->index('order_foward_id');
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
        Schema::dropIfExists('order_foward_addons');
    }
}