<?php

namespace App\Models;

use App\Models\Pasien;
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

    public function pasien(): HasOne
    {
        return $this->hasOne(Pasien::class, 'id', 'pasien_id');
    }

    public function dokter(): HasOne
    {
        return $this->hasOne(Dokter::class, 'id', 'dokter_id');
    }
}