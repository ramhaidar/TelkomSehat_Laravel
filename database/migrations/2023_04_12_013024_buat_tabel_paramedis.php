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
        Schema::create ( 'paramedics', function (Blueprint $table)
        { // Rename table
            $table->id ();
            $table->unsignedBigInteger ( 'user_id' )->nullable (); // Rename column to match model
            $table->foreign ( 'user_id' )->references ( 'id' )->on ( 'users' ); // Adjust foreign key column name
            $table->string ( 'username' );
            $table->string ( 'paramedic_code' ); // Rename to match model
            $table->string ( 'phone_number' ); // Rename to match model
            $table->timestamps ();
        } );

        Schema::table ( 'users', function (Blueprint $table)
        {
            $table->unsignedBigInteger ( 'paramedic_id' )->after ( 'doctor_id' )->nullable (); // Rename column to match model
            $table->foreign ( 'paramedic_id' )->references ( 'id' )->on ( 'paramedics' ); // Adjust foreign key
        } );
    }

    /**
     * Reverse the migrations.
     */
    public function down () : void
    {
        Schema::table ( 'paramedis', function (Blueprint $table)
        {
            $table->dropForeign ( [ 'userid' ] );
            $table->dropColumn ( 'userid' );
        } );

        Schema::table ( 'users', function (Blueprint $table)
        {
            $table->dropForeign ( [ 'paramedis_id' ] );
            $table->dropColumn ( 'paramedis_id' );
        } );

        Schema::dropIfExists ( 'paramedis' );
    }
};