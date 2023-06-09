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
            $table->unsignedBigInteger('pasien_id')->nullable();
            $table->unsignedBigInteger('dokter_id')->nullable();
            $table->foreign('pasien_id')->references('id')->on('mahasiswa');
            $table->foreign('dokter_id')->references('id')->on('dokter');
            $table->text('keluhan')->nullable();
            $table->text('keterangan')->nullable();
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
            $table->dropForeign(['pasien_id']);
            $table->dropColumn('pasien_id');

            $table->dropForeign(['dokter_id']);
            $table->dropColumn('dokter_id');
        });

        Schema::dropIfExists('konsultasi');
    }
};