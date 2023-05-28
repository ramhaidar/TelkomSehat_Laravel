<?php

namespace App\Models;

use App\Models\Dokter;
use App\Models\Pasien;
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

    public function pasien(): HasOne
    {
        return $this->hasOne(Pasien::class, 'id', 'pasien_id');
    }

    public function dokter(): HasOne
    {
        return $this->hasOne(Dokter::class, 'id', 'dokter_id');
    }
}