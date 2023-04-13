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
            $table->unsignedBigInteger('mahasiswaid')->nullable();
            $table->unsignedBigInteger('paramedisid')->nullable();
            $table->foreign('mahasiswaid')->references('id')->on('mahasiswa');
            $table->foreign('paramedisid')->references('id')->on('paramedis');
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
            $table->dropForeign(['mahasiswaid']);
            $table->dropColumn('mahasiswaid');

            $table->dropForeign(['paramedisid']);
            $table->dropColumn('paramedisid');
        });

        Schema::dropIfExists('penjemputan');
    }
};