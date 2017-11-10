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
            $table->decimal('width', 10, 2);
            $table->decimal('height', 10, 2);
            $table->decimal('depth', 10, 2);
            $table->decimal('weight', 10, 2);
            $table->string('unit_measure', 5);
            $table->string('weight_measure', 5);
            $table->string('note')->nullable();;
            $table->tinyInteger('status_id');
            $table->integer('object_owner');
            $table->integer('warehouse_id');

            $table->index('object_owner');
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
        Schema::dropIfExists('packages');
    }
}
