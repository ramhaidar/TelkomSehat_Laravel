<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateParamedisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('paramedis', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('userid')->nullable();
            $table->string('username');
            $table->string('kodeParamedis');
            $table->string('nomortelepon');
            $table->timestamps();
            
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
        Schema::dropIfExists('paramedis');
    }
}
