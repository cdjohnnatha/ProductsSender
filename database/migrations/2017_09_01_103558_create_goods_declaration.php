<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGoodsDeclaration extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('goods_declarations', function (Blueprint $table) {
            $table->increments('id');

            $table->string('description', 250);
            $table->integer('quantity');
            $table->decimal('unit_price');
            $table->decimal('total_unit');
            $table->integer('incoming_packages_id');

            $table->index('incoming_packages_id');

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
        Schema::dropIfExists('goods_declarations');
    }
}
