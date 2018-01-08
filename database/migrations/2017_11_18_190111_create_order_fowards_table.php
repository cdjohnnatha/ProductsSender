<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrderFowardsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order_fowards', function (Blueprint $table) {
            $table->increments('id');
            $table->decimal('price');
            $table->string('track_number')->nullable();
            $table->string('goshippo_shipment')->nullable();
            $table->integer('order_id');
            $table->integer('client_address_id');
            $table->integer('provider_id')->nullable();
            $table->integer('package_id');

            $table->index('order_id');
            $table->index('client_address_id');
            $table->index('provider_id');
            $table->index('package_id');
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
        Schema::dropIfExists('order_fowards');
    }
}
