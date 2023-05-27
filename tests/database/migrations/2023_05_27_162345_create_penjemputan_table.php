<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePenjemputanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('penjemputan', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('pasien_id')->nullable();
            $table->unsignedBigInteger('paramedis_id')->nullable();
            $table->string('lintang');
            $table->string('bujur');
            $table->boolean('selesai')->default(0);
            $table->timestamps();
            
            $table->foreign('pasien_id', 'penjemputan_mahasiswaid_foreign')->references('id')->on('mahasiswa');
            $table->foreign('paramedis_id', 'penjemputan_paramedisid_foreign')->references('id')->on('paramedis');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('penjemputan');
    }
}
