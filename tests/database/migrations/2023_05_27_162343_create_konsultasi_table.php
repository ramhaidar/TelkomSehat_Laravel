<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKonsultasiTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('konsultasi', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('pasien_id')->nullable();
            $table->unsignedBigInteger('dokter_id')->nullable();
            $table->text('keluhan')->nullable();
            $table->text('keterangan')->nullable();
            $table->text('jawaban')->nullable();
            $table->timestamps();
            
            $table->foreign('dokter_id', 'konsultasi_dokterid_foreign')->references('id')->on('dokter');
            $table->foreign('pasien_id', 'konsultasi_mahasiswaid_foreign')->references('id')->on('mahasiswa');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('konsultasi');
    }
}
