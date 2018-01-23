<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAdminInformationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('admin_informations', function (Blueprint $table) {
            $table->increments('id');
            $table->string('fullname', 100);
            $table->string('country', 50);
            $table->string('phone', 30);
            $table->integer('company_id');
            $table->integer('user_id');

            $table->index('company_id');
            $table->index('user_id');
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
        Schema::dropIfExists('admin_informations');
    }
}
