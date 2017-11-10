<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAddressGeonameCodesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('address_geoname_codes', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('country');
            $table->integer('state');
            $table->integer('city');
            $table->integer('address_id');

            $table->index('country');
            $table->index('state');
            $table->index('city');
            $table->index('address_id');

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
        Schema::dropIfExists('address_geoname_codes');
    }
}
