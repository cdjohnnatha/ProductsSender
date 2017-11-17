<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 100);
            $table->string('surname', 100);
            $table->string('email')->unique();
            $table->string('phone', 20);
            $table->string('password');
            $table->string('rg');
            $table->string('cpf');
            $table->boolean('confirmed')->default(0);
            $table->string('confirmation_code')->nullable();
            $table->integer('subscription_id');
            $table->integer('default_address')->nullable();

            $table->index('default_address');
            $table->index('subscription_id');
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
