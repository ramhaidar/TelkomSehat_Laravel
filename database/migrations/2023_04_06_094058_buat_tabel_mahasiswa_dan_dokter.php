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
        Schema::create('mahasiswa', function (Blueprint $table) {
            $table->id();
            $table->string('nim')->unique();
            $table->string('username')->unique();
            $table->string('nomortelepon')->unique();
            $table->unsignedBigInteger('userid')->nullable();
            $table->foreign('userid')->references('id')->on('users');
            $table->timestamps();
        });

        Schema::create('dokter', function (Blueprint $table) {
            $table->id();
            $table->string('kodedokter')->unique();
            $table->string('username')->unique();
            $table->string('nomortelepon')->unique();
            $table->string('spesialis');
            $table->unsignedBigInteger('userid')->nullable();
            $table->foreign('userid')->references('id')->on('users');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('mahasiswa', function (Blueprint $table) {
            $table->dropForeign(['userid']);
            $table->dropColumn('userid');
        });

        Schema::table('dokter', function (Blueprint $table) {
            $table->dropForeign(['userid']);
            $table->dropColumn('userid');
        });

        Schema::dropIfExists('mahasiswa');
        Schema::dropIfExists('dokter');
    }
};