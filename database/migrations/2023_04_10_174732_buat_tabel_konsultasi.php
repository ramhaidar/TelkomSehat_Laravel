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
        Schema::create ( 'consultations', function (Blueprint $table)
        { // Rename table
            $table->id ();
            $table->unsignedBigInteger ( 'patient_id' )->nullable (); // Rename to match model
            $table->unsignedBigInteger ( 'doctor_id' )->nullable (); // Rename to match model
            $table->foreign ( 'patient_id' )->references ( 'id' )->on ( 'patients' ); // Adjust foreign key
            $table->foreign ( 'doctor_id' )->references ( 'id' )->on ( 'doctors' ); // Adjust foreign key
            $table->text ( 'complaint' )->nullable (); // Rename to match model
            $table->text ( 'annotation' )->nullable (); // Rename to match model
            $table->text ( 'answer' )->nullable (); // Rename to match model
            $table->timestamps ();
        } );

    }

    /**
     * Reverse the migrations.
     */
    public function down () : void
    {
        Schema::table ( 'konsultasi', function (Blueprint $table)
        {
            $table->dropForeign ( [ 'pasien_id' ] );
            $table->dropColumn ( 'pasien_id' );

            $table->dropForeign ( [ 'dokter_id' ] );
            $table->dropColumn ( 'dokter_id' );
        } );

        Schema::dropIfExists ( 'konsultasi' );
    }
};