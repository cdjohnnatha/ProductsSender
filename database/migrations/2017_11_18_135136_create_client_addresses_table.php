<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateClientAddressesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('client_addresses', function (Blueprint $table) {
            $table->increments('id');
            $table->string('label', 30);
            $table->string('owner_name', 50);
            $table->string('owner_surname', 50);
            $table->string('company_name', 50);
            $table->string('country', 50);
            $table->string('street', 100);
            $table->string('street2', 100)->nullable();
            $table->string('city', 50);
            $table->string('state', 50);
            $table->string('postal_code', 20);
            $table->string('phone', 20);
            $table->string('number', 15);
            $table->string('formatted_address', 200);
            $table->integer('client_id');

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
        Schema::dropIfExists('client_addresses');
    }
}
