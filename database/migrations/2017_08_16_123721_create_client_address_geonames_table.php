<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateClientAddressGeonamesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('client_address_geonames', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('country');
            $table->integer('state');
            $table->integer('city');
            $table->integer('client_address_id');

            $table->index('country');
            $table->index('state');
            $table->index('city');
            $table->index('client_address_id');

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
        Schema::dropIfExists('client_address_geonames');
    }
}
