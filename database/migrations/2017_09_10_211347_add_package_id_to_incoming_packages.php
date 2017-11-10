 e<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddPackageIdToIncomingPackages extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('incoming_packages', function (Blueprint $table) {
            $table->integer('package_id')->nullable();
            $table->index('package_id')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('incoming_packages', function (Blueprint $table) {
            $table->dropColumn('package_id');
            $table->dropIndex('package_id');
        });
    }
}
