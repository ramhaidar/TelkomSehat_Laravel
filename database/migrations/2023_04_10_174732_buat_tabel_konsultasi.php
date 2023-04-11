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
        Schema::create('konsultasi', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('mahasiswaid')->nullable();
            $table->unsignedBigInteger('dokterid')->nullable();
            $table->foreign('mahasiswaid')->references('id')->on('mahasiswa');
            $table->foreign('dokterid')->references('id')->on('dokter');
            $table->text('keluhan');
            $table->text('jawaban')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('konsultasi', function (Blueprint $table) {
            $table->dropForeign(['mahasiswaid']);
            $table->dropColumn('mahasiswaid');

            $table->dropForeign(['dokterid']);
            $table->dropColumn('dokterid');
        });

        Schema::dropIfExists('konsultasi');
    }
};