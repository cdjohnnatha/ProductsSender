<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class RemoveColumnInitialFeeAndMaxInitialWeight extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('fee_weight_rules', function (Blueprint $table) {
            $table->dropColumn('initial_fee');
            $table->dropColumn('max_initial_weight');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('fee_weight_rules', function (Blueprint $table) {
            $table->decimal('initial_fee');
            $table->decimal('max_initial_weight');
        });
    }
}
