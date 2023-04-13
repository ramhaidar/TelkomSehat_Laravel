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
        Schema::create('paramedis', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('userid')->nullable();
            $table->foreign('userid')->references('id')->on('users');
            $table->string('username');
            $table->string('kodeParamedis');
            $table->string('nomortelepon');

            $table->timestamps();
        });

        Schema::table('users', function (Blueprint $table) {
            $table->unsignedBigInteger('paramedisid')->after('dokterid')->nullable();
            $table->foreign('paramedisid')->references('id')->on('paramedis');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('paramedis', function (Blueprint $table) {
            $table->dropForeign(['userid']);
            $table->dropColumn('userid');
        });

        Schema::table('users', function (Blueprint $table) {
            $table->dropForeign(['paramedisid']);
            $table->dropColumn('paramedisid');
        });

        Schema::dropIfExists('paramedis');
    }
};