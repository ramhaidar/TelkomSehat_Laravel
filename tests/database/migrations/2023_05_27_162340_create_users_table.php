<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->nullable()->unique('users_email_unique');
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->unsignedBigInteger('pasien_id')->nullable();
            $table->unsignedBigInteger('dokter_id')->nullable();
            $table->unsignedBigInteger('paramedis_id')->nullable();
            $table->rememberToken();
            $table->string('mobile_app_token')->nullable();
            $table->timestamps();
            
            $table->foreign('dokter_id', 'users_dokterid_foreign')->references('id')->on('dokter');
            $table->foreign('pasien_id', 'users_mahasiswaid_foreign')->references('id')->on('mahasiswa');
            $table->foreign('paramedis_id', 'users_paramedisid_foreign')->references('id')->on('paramedis');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
