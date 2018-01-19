<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class RenameColumnGoshipporateToGoshippoObjectId extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('order_fowards', function (Blueprint $table) {
            $table->renameColumn('goshippo_rate_id', 'goshippo_object_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('order_fowards', function (Blueprint $table) {
            $table->renameColumn('goshippo_object_id', 'goshippo_rate_id');
        });
    }
}
