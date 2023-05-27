<?php

namespace App\Models;

use App\Models\Mahasiswa;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Reservasi extends Model
{
    use HasFactory;

    protected $primaryKey = 'id';
    protected $table = 'reservasi';

    protected $fillable = [
        'pasien_id',
        'dokter_id',
        'spesialis',
        'tanggal',
        'waktu',
        'keluhan',
        'berobat',
        'konsultasi',
    ];

    public function mahasiswa(): HasOne
    {
        return $this->hasOne(Mahasiswa::class, 'id', 'pasien_id');
    }

    public function dokter(): HasOne
    {
        return $this->hasOne(Dokter::class, 'id', 'dokter_id');
    }
}