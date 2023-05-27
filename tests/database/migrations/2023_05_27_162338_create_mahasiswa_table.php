<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMahasiswaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mahasiswa', function (Blueprint $table) {
            $table->id();
            $table->string('nim')->unique('mahasiswa_nim_unique');
            $table->string('username')->unique('mahasiswa_username_unique');
            $table->string('nomortelepon')->unique('mahasiswa_nomortelepon_unique');
            $table->unsignedBigInteger('userid')->nullable();
            $table->timestamps();
            
            $table->foreign('userid', 'mahasiswa_userid_foreign')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('mahasiswa');
    }
}
