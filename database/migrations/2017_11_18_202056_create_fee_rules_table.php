<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFeeRulesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fee_rules', function (Blueprint $table) {
            $table->increments('id');
            $table->decimal('initial_fee');
            $table->decimal('max_weight_fee');
            $table->decimal('overweight_fee');
            $table->integer('warehouse_id');

            $table->index('warehouse_id');
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
        Schema::dropIfExists('fee_rules');
    }
}
