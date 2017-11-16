<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAddressesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('addresses', function (Blueprint $table) {
            $table->increments('id');
            $table->string('label', 30);
            $table->string('owner_name', 50);
            $table->string('owner_surname', 50);
            $table->string('company_name', 50)->nullable();
            $table->string('country', 50);
            $table->string('street', 100);
            $table->string('street2', 100)->nullable();
            $table->string('city', 50);
            $table->string('state', 50);
            $table->string('postal_code', 20);
            $table->string('phone', 20);
            $table->integer('addressable_id');
            $table->string('addressable_type');
            $table->string('number', 15);
            $table->string('formatted_address', 200);
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
        Schema::dropIfExists('addresses');
    }
}
