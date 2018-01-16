<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ChangeRelationshipOrderFeesToOrderPackageFees extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('order_fee_rules', function (Blueprint $table) {
            $table->renameColumn('order_id', 'order_package_id');
            $table->rename('order_package_fee_rules');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('order_package_fee_rules', function (Blueprint $table) {
            $table->renameColumn('order_package_id', 'order_id');
            $table->rename('order_fee_rules');
        });
    }
}
