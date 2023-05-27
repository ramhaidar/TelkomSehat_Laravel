<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDokterTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dokter', function (Blueprint $table) {
            $table->id();
            $table->string('kodedokter')->unique('dokter_kodedokter_unique');
            $table->string('username')->unique('dokter_username_unique');
            $table->string('nomortelepon')->unique('dokter_nomortelepon_unique');
            $table->string('spesialis');
            $table->unsignedBigInteger('userid')->nullable();
            $table->timestamps();
            
            $table->foreign('userid', 'dokter_userid_foreign')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('dokter');
    }
}
