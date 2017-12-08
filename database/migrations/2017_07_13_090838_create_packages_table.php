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
            $table->string('content_type')->nullable();
            $table->decimal('width', 10, 2)->nullable();
            $table->decimal('height', 10, 2)->nullable();
            $table->decimal('depth', 10, 2)->nullable();
            $table->string('unit_measure', 5)->nullable();
            $table->decimal('weight', 10, 2)->nullable();
            $table->string('weight_measure', 5)->nullable();
            $table->decimal('total_goods')->nullable();
            $table->string('note')->nullable();
            $table->string('description')->nullable();

            $table->integer('client_id');
            $table->integer('package_status_id');
            $table->integer('company_warehouse_id');

            $table->index('company_warehouse_id');
            $table->index('client_id');
            $table->index('package_status_id');


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
