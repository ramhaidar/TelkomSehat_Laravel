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
        Schema::create ( 'patients', function (Blueprint $table)
        { // Rename table
            $table->id ();
            $table->string ( 'nim' )->unique ();
            $table->string ( 'username' )->unique ();
            $table->string ( 'phone_number' )->unique (); // Rename to match model
            $table->unsignedBigInteger ( 'user_id' )->nullable (); // Rename column to match model
            $table->foreign ( 'user_id' )->references ( 'id' )->on ( 'users' ); // Adjust foreign key column name
            $table->timestamps ();
        } );

        Schema::create ( 'doctors', function (Blueprint $table)
        { // Rename table
            $table->id ();
            $table->string ( 'doctor_code' )->unique (); // Rename to match model
            $table->string ( 'username' )->unique ();
            $table->string ( 'phone_number' )->unique (); // Rename to match model
            $table->string ( 'speciality' ); // Rename to match model
            $table->unsignedBigInteger ( 'user_id' )->nullable (); // Rename column to match model
            $table->foreign ( 'user_id' )->references ( 'id' )->on ( 'users' ); // Adjust foreign key column name
            $table->timestamps ();
        } );
    }

    /**
     * Reverse the migrations.
     */
    public function down () : void
    {
        Schema::table ( 'mahasiswa', function (Blueprint $table)
        {
            $table->dropForeign ( [ 'userid' ] );
            $table->dropColumn ( 'userid' );
        } );

        Schema::table ( 'dokter', function (Blueprint $table)
        {
            $table->dropForeign ( [ 'userid' ] );
            $table->dropColumn ( 'userid' );
        } );

        Schema::dropIfExists ( 'mahasiswa' );
        Schema::dropIfExists ( 'dokter' );
    }
};