<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('reservasi', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('mahasiswaid')->nullable();
            $table->unsignedBigInteger('dokterid')->nullable();
            $table->foreign('mahasiswaid')->references('id')->on('mahasiswa');
            $table->foreign('dokterid')->references('id')->on('dokter');
            $table->string('spesialis');
            $table->date('tanggal');
            $table->string('waktu');
            $table->text('keluhan');
            $table->boolean('berobat');
            $table->boolean('konsultasi');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('reservasi', function (Blueprint $table) {
            $table->dropForeign(['mahasiswaid']);
            $table->dropColumn('mahasiswaid');

            $table->dropForeign(['dokterid']);
            $table->dropColumn('dokterid');
        });
        Schema::dropIfExists('reservasi');
    }
};