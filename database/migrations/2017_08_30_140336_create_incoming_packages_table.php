<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateIncomingPackagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('incoming_packages', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('warehouse_id');
            $table->string('provider', 50);
            $table->string('addressee', 50);
            $table->string('track_number', 50);
            $table->string('description');
            $table->decimal('total_goods');
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
        Schema::dropIfExists('incoming_packages');
    }
}
