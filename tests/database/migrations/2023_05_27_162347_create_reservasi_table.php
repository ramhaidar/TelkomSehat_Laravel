<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReservasiTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reservasi', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('pasien_id')->nullable();
            $table->unsignedBigInteger('dokter_id')->nullable();
            $table->string('spesialis');
            $table->date('tanggal');
            $table->integer('waktu');
            $table->text('keluhan');
            $table->timestamps();
            
            $table->foreign('dokter_id', 'reservasi_dokterid_foreign')->references('id')->on('dokter');
            $table->foreign('pasien_id', 'reservasi_mahasiswaid_foreign')->references('id')->on('mahasiswa');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('reservasi');
    }
}
