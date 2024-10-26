<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up () : void
    {
        Schema::table ( 'users', function (Blueprint $table)
        {
            $table->unsignedBigInteger ( 'patient_id' )->after ( 'password' )->nullable (); // Rename to match model
            $table->unsignedBigInteger ( 'doctor_id' )->after ( 'patient_id' )->nullable (); // Rename to match model
            $table->foreign ( 'patient_id' )->references ( 'id' )->on ( 'patients' ); // Adjust foreign key
            $table->foreign ( 'doctor_id' )->references ( 'id' )->on ( 'doctors' ); // Adjust foreign key
        } );
    }

    /**
     * Reverse the migrations.
     */
    public function down () : void
    {
        Schema::table ( 'users', function (Blueprint $table)
        {
            $table->dropForeign ( [ 'pasien_id' ] );
            $table->dropColumn ( 'pasien_id' );

            $table->dropForeign ( [ 'dokter_id' ] );
            $table->dropColumn ( 'dokter_id' );
        } );
    }
};