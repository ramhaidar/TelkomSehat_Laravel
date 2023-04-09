<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Mahasiswa;
use Faker\Factory as Faker;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class AwalanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $Faker = Faker::create();

        // —————————————————————————————————————————————————————————— //

        $theID = Mahasiswa::create([
            'nim' => '1301204017',
            'username' => 'robithnaufal',
            'nomortelepon' => '6281246229522',
        ])->id;

        User::create([
            'name' => 'Robith Naufal Razzak',
            'email' => 'robithnaufal@student.telkomuniversity.ac.id',
            'password' => Hash::make("robithnaufal123"),
            'mahasiswaid' => $theID,
        ]);

        // —————————————————————————————————————————————————————————— //

        $theID = Mahasiswa::create([
            'nim' => '1301204459',
            'username' => 'haidarx',
            'nomortelepon' => '6281238777306',
        ])->id;

        User::create([
            'name' => 'Haidaruddin Muhammad Ramdhan',
            'email' => 'haidarx@student.telkomuniversity.ac.id',
            'password' => Hash::make("haidarx123"),
            'mahasiswaid' => $theID,
        ]);

        // —————————————————————————————————————————————————————————— //

        $theID = Mahasiswa::create([
            'nim' => '1301204112',
            'username' => 'dimasrfq',
            'nomortelepon' => '6285155106991',
        ])->id;

        User::create([
            'name' => 'Muhammad Dimas Rifki Irianto',
            'email' => 'dimasrfq@student.telkomuniversity.ac.id',
            'password' => Hash::make("dimas123"),
            'mahasiswaid' => $theID,
        ]);

        // —————————————————————————————————————————————————————————— //

        $theID = Mahasiswa::create([
            'nim' => '1301204231',
            'username' => 'ahmadfasya',
            'nomortelepon' => '6285755347595',
        ])->id;

        User::create([
            'name' => 'Ahmad Fasya Adila',
            'email' => 'ahmadfasya@student.telkomuniversity.ac.id',
            'password' => Hash::make("fasya123"),
            'mahasiswaid' => $theID,
        ]);

        // —————————————————————————————————————————————————————————— //

        $theID = Mahasiswa::create([
            'nim' => '1301204416',
            'username' => 'hiksal',
            'nomortelepon' => '628112104949',
        ])->id;

        User::create([
            'name' => 'Muhammad Hiksal',
            'email' => 'hiksal@student.telkomuniversity.ac.id',
            'password' => Hash::make("hiksal321"),
            'mahasiswaid' => $theID,
        ]);
    }
}