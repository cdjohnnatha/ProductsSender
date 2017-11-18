<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePackagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('packages', function (Blueprint $table) {
            $table->increments('id');
            $table->string('provider', 50)->nullable();
            $table->string('store_name', 50)->nullable();
            $table->string('track_number', 50)->nullable();
            $table->string('merchandise')->nullable();
            $table->string('content_type')->nullable();
            $table->decimal('width', 10, 2)->nullable();
            $table->decimal('height', 10, 2)->nullable();
            $table->decimal('depth', 10, 2)->nullable();
            $table->string('unit_measure', 5)->nullable();
            $table->decimal('weight', 10, 2)->nullable();
            $table->string('weight_measure', 5)->nullable();

            $table->decimal('total_goods')->nullable();
            $table->decimal('total_addons')->nullable();

            $table->integer('client_id');
            $table->integer('status_id')->nullable();
            $table->integer('warehouse_id');

            $table->index('warehouse_id');
            $table->index('status_id');
            $table->index('client_id');


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
        Schema::dropIfExists('packages');
    }
}
