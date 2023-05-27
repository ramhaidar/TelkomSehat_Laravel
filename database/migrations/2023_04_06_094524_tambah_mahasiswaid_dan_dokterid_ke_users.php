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
        Schema::table('users', function (Blueprint $table) {
            $table->unsignedBigInteger('pasien_id')->after('password')->nullable();
            $table->unsignedBigInteger('dokter_id')->after('pasien_id')->nullable();
            $table->foreign('pasien_id')->references('id')->on('mahasiswa');
            $table->foreign('dokter_id')->references('id')->on('dokter');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropForeign(['pasien_id']);
            $table->dropColumn('pasien_id');

            $table->dropForeign(['dokter_id']);
            $table->dropColumn('dokter_id');
        });
    }
};