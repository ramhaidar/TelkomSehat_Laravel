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
            $table->unsignedBigInteger('mahasiswaid')->after('password')->nullable();
            $table->unsignedBigInteger('dokterid')->after('mahasiswaid')->nullable();
            $table->foreign('mahasiswaid')->references('id')->on('mahasiswa');
            $table->foreign('dokterid')->references('id')->on('dokter');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropForeign(['mahasiswaid']);
            $table->dropColumn('mahasiswaid');

            $table->dropForeign(['dokterid']);
            $table->dropColumn('dokterid');
        });
    }
};