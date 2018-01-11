<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFeeWeightRulesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fee_weight_rules', function (Blueprint $table) {
            $table->increments('id');
            $table->decimal('initial_fee');
            $table->decimal('max_weight_fee');
            $table->decimal('overweight_fee');

            $table->decimal('max_initial_weight');
            $table->decimal('max_weight');
            $table->decimal('overweight');
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
        Schema::dropIfExists('fee_weight_rules');
    }
}
