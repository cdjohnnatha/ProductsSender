<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrderFeeWeightRulesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order_fee_weight_rules', function (Blueprint $table) {
            $table->increments('id');
            $table->decimal('total');
            $table->decimal('overweight')->nullable();
            $table->integer('fee_weight_rules_id');
            $table->integer('order_package_id');

            $table->index('fee_weight_rules_id');
            $table->index('order_package_id');

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
        Schema::table('order_fee_weight_rules', function (Blueprint $table) {
            Schema::dropIfExists('order_fee_weight_rules');
        });
    }
}
