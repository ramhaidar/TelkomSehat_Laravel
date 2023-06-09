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
        Schema::create('penjemputan', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('pasien_id')->nullable();
            $table->unsignedBigInteger('paramedis_id')->nullable();
            $table->foreign('pasien_id')->references('id')->on('mahasiswa');
            $table->foreign('paramedis_id')->references('id')->on('paramedis');
            $table->string('lintang');
            $table->string('bujur');
            $table->boolean('selesai')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('penjemputan', function (Blueprint $table) {
            $table->dropForeign(['pasien_id']);
            $table->dropColumn('pasien_id');

            $table->dropForeign(['paramedis_id']);
            $table->dropColumn('paramedis_id');
        });

        Schema::dropIfExists('penjemputan');
    }
};