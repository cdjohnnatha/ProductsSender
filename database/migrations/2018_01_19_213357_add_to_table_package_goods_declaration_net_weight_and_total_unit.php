<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddToTablePackageGoodsDeclarationNetWeightAndTotalUnit extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('package_goods_declarations', function (Blueprint $table) {
            $table->decimal('net_weight');
            $table->string('mass_unit', 10);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('package_goods_declarations', function (Blueprint $table) {
            $table->dropColumn('net_weight');
            $table->dropColumn('mass_unit', 10);
        });
    }
}
