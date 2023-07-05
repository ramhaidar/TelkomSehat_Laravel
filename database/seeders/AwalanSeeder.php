<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Doctor;
use App\Models\Patient;
use App\Models\Paramedic;
use Faker\Factory as Faker;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class AwalanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run () : void
    {
        $Faker = Faker::create ();

        // —————————————————————————————————————————————————————————— //

        $patient_id = Patient::create ( [ 
            // 'nim' => '1301204017',
            'username'     => 'robithnaufal',
            'phone_number' => '6281246229522',
        ] )->id;

        $user_id = User::create ( [ 
            'name'       => 'Robith Naufal Razzak',
            'email'      => 'robithnaufal@student.telkomuniversity.ac.id',
            'password'   => Hash::make ( "robithnaufal123" ),
            'patient_id' => $patient_id,
        ] )->id;

        Patient::find ( $patient_id )->update ( [ 'user_id' => $user_id ] );

        // —————————————————————————————————————————————————————————— //

        $patient_id = Patient::create ( [ 
            // 'nim' => '1301204459',
            'username'     => 'haidarx',
            'phone_number' => '6281238777306',
        ] )->id;

        $user_id = User::create ( [ 
            'name'       => 'Haidaruddin Muhammad Ramdhan',
            'email'      => 'haidarx@student.telkomuniversity.ac.id',
            'password'   => Hash::make ( "haidarx123" ),
            'patient_id' => $patient_id,
        ] )->id;

        Patient::find ( $patient_id )->update ( [ 'user_id' => $user_id ] );

        // —————————————————————————————————————————————————————————— //

        $patient_id = Patient::create ( [ 
            // 'nim' => '1301204112',
            'username'     => 'dimasrfq',
            'phone_number' => '6285155106991',
        ] )->id;

        $user_id = User::create ( [ 
            'name'       => 'Muhammad Dimas Rifki Irianto',
            'email'      => 'dimasrfq@student.telkomuniversity.ac.id',
            'password'   => Hash::make ( "dimas123" ),
            'patient_id' => $patient_id,
        ] )->id;

        Patient::find ( $patient_id )->update ( [ 'user_id' => $user_id ] );

        // —————————————————————————————————————————————————————————— //

        $patient_id = Patient::create ( [ 
            // 'nim' => '1301204231',
            'username'     => 'ahmadfasya',
            'phone_number' => '6285755347595',
        ] )->id;

        $user_id = User::create ( [ 
            'name'       => 'Ahmad Fasya Adila',
            'email'      => 'ahmadfasya@student.telkomuniversity.ac.id',
            'password'   => Hash::make ( "fasya123" ),
            'patient_id' => $patient_id,
        ] )->id;

        Patient::find ( $patient_id )->update ( [ 'user_id' => $user_id ] );

        // —————————————————————————————————————————————————————————— //

        $patient_id = Patient::create ( [ 
            // 'nim' => '1301204416',
            'username'     => 'hiksal',
            'phone_number' => '628112104949',
        ] )->id;

        $user_id = User::create ( [ 
            'name'       => 'Muhammad Hiksal Daeng Jusuf Bauw',
            'email'      => 'hiksal@student.telkomuniversity.ac.id',
            'password'   => Hash::make ( "hiksal321" ),
            'patient_id' => $patient_id,
        ] )->id;

        Patient::find ( $patient_id )->update ( [ 'user_id' => $user_id ] );

        // —————————————————————————————————————————————————————————— //

        $doctor_id = Doctor::create ( [ 
            'doctor_code'  => 'FSV',
            'username'     => 'fanie',
            'phone_number' => '627617891983',
            'speciality'   => 'Dokter Gigi',
        ] )->id;

        $user_id = User::create ( [ 
            'name'      => 'drg. Febriyanti Sthefanie',
            'email'     => 'sthefanie@telkomuniversity.ac.id',
            'password'  => Hash::make ( "fanie123" ),
            'doctor_id' => $doctor_id,
        ] )->id;

        Doctor::find ( $doctor_id )->update ( [ 'user_id' => $user_id ] );

        // —————————————————————————————————————————————————————————— //

        $doctor_id = Doctor::create ( [ 
            'doctor_code'  => 'SOL',
            'username'     => 'solikin',
            'phone_number' => '622156959333',
            'speciality'   => 'Dokter Umum',
        ] )->id;

        $user_id = User::create ( [ 
            'name'      => 'dr. Ahmad Solikin Hidayatullah',
            'email'     => 'solikin@telkomuniversity.ac.id',
            'password'  => Hash::make ( "solikin123" ),
            'doctor_id' => $doctor_id,
        ] )->id;

        Doctor::find ( $doctor_id )->update ( [ 'user_id' => $user_id ] );

        // —————————————————————————————————————————————————————————— //

        $doctor_id = Doctor::create ( [ 
            'doctor_code'  => 'GAW',
            'username'     => 'gedeagung',
            'phone_number' => '6284845123075',
            'speciality'   => 'Dokter Kulit',
        ] )->id;

        $user_id = User::create ( [ 
            'name'      => 'Gede Agung Ary Wisudiawan',
            'email'     => 'gedeagung@telkomuniversity.ac.id',
            'password'  => Hash::make ( "gedeagung123" ),
            'doctor_id' => $doctor_id,
        ] )->id;

        Doctor::find ( $doctor_id )->update ( [ 'user_id' => $user_id ] );

        // —————————————————————————————————————————————————————————— //

        $doctor_id = Doctor::create ( [ 
            'doctor_code'  => 'COK',
            'username'     => 'tjokor',
            'phone_number' => '6292760268633',
            'speciality'   => 'Psikiater',
        ] )->id;

        $user_id = User::create ( [ 
            'name'      => 'dr. Gede Agung Ary Wisudiawan, Sp.KK',
            'email'     => 'tjokor@telkomuniversity.ac.id',
            'password'  => Hash::make ( "tjokor123" ),
            'doctor_id' => $doctor_id,
        ] )->id;

        Doctor::find ( $doctor_id )->update ( [ 'user_id' => $user_id ] );

        // —————————————————————————————————————————————————————————— //

        $doctor_id = Doctor::create ( [ 
            'doctor_code'  => 'ADR',
            'username'     => 'drian',
            'phone_number' => '6210615006816',
            'speciality'   => 'Dokter THT',
        ] )->id;

        $user_id = User::create ( [ 
            'name'      => 'dr. Andrian Rakhmatsyah, Sp.THT',
            'email'     => 'drian@telkomuniversity.ac.id',
            'password'  => Hash::make ( "drian123" ),
            'doctor_id' => $doctor_id,
        ] )->id;

        Doctor::find ( $doctor_id )->update ( [ 'user_id' => $user_id ] );

        // —————————————————————————————————————————————————————————— //

        $paramedic_id = Paramedic::create ( [ 
            'paramedic_code' => 'TPR',
            'username'       => 'tapir',
            'phone_number'   => '6281593942394',
        ] )->id;

        $user_id = User::create ( [ 
            'name'         => 'Tim Tapir',
            'email'        => 'tapir@telkomuniversity.ac.id',
            'password'     => Hash::make ( "tapir123" ),
            'paramedic_id' => $paramedic_id,
        ] )->id;

        Paramedic::find ( $paramedic_id )->update ( [ 'user_id' => $user_id ] );

        // —————————————————————————————————————————————————————————— //

        $paramedic_id = Paramedic::create ( [ 
            'paramedic_code' => 'KSR',
            'username'       => 'kasuari',
            'phone_number'   => '6264372066006',
        ] )->id;

        $user_id = User::create ( [ 
            'name'         => 'Tim Kasuari',
            'email'        => 'kasuari@telkomuniversity.ac.id',
            'password'     => Hash::make ( "kasuari123" ),
            'paramedic_id' => $paramedic_id,
        ] )->id;

        Paramedic::find ( $paramedic_id )->update ( [ 'user_id' => $user_id ] );

        // —————————————————————————————————————————————————————————— //

        $paramedic_id = Paramedic::create ( [ 
            'paramedic_code' => 'KMD',
            'username'       => 'komodo',
            'phone_number'   => '6278357391896',
        ] )->id;

        $user_id = User::create ( [ 
            'name'         => 'Tim Komodo',
            'email'        => 'komodo@telkomuniversity.ac.id',
            'password'     => Hash::make ( "komodo123" ),
            'paramedic_id' => $paramedic_id,
        ] )->id;

        Paramedic::find ( $paramedic_id )->update ( [ 'user_id' => $user_id ] );
    }
}