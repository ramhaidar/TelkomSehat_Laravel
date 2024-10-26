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
        Schema::create ( 'evacuations', function (Blueprint $table)
        { // Rename table
            $table->id ();
            $table->unsignedBigInteger ( 'patient_id' )->nullable (); // Rename to match model
            $table->unsignedBigInteger ( 'paramedic_id' )->nullable (); // Rename to match model
            $table->foreign ( 'patient_id' )->references ( 'id' )->on ( 'patients' ); // Adjust foreign key
            $table->foreign ( 'paramedic_id' )->references ( 'id' )->on ( 'paramedics' ); // Adjust foreign key
            $table->string ( 'latitude' ); // Rename to match model
            $table->string ( 'longitude' ); // Rename to match model
            $table->boolean ( 'is_done' )->default ( false ); // Rename to match model
            $table->timestamps ();
        } );
    }

    /**
     * Reverse the migrations.
     */
    public function down () : void
    {
        Schema::table ( 'penjemputan', function (Blueprint $table)
        {
            $table->dropForeign ( [ 'pasien_id' ] );
            $table->dropColumn ( 'pasien_id' );

            $table->dropForeign ( [ 'paramedis_id' ] );
            $table->dropColumn ( 'paramedis_id' );
        } );

        Schema::dropIfExists ( 'penjemputan' );
    }
};