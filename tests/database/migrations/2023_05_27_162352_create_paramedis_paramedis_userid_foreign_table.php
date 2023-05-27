<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateParamedisParamedisUseridForeignTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('paramedis', function (Blueprint $table) {
            $table->foreign('userid', 'paramedis_userid_foreign')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('paramedis', function(Blueprint $table){
            $table->dropForeign('paramedis_userid_foreign');
        });
    }
}
