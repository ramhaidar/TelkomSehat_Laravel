<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Konsultasi extends Model
{
    use HasFactory;

    protected $primaryKey = 'id';
    protected $table = 'konsultasi';

    protected $fillable = [
        'pasien_id',
        'dokter_id',
        'keluhan',
        'keterangan',
        'jawaban',
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