<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddActiveAndTypeToSubscriptions extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //TODO: colocando INDEX em variáveis BOOLEAN???
        Schema::table('subscriptions', function (Blueprint $table) {
            $table->boolean('active');
            $table->boolean('principal');
            $table->smallInteger('period');

            $table->index('active', 'active_index');
            $table->index('period', 'period_index');
            $table->index('principal', 'principal_index');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('subscriptions', function (Blueprint $table) {
            $table->dropColumn('active');
            $table->dropColumn('period');
            $table->dropColumn('principal');
            $table->dropIndex(['active_index', 'period_index', 'principal_index']);
        });
    }
}
