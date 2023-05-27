<?php

namespace App\Models;

use App\Models\Mahasiswa;
use App\Models\Paramedis;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Penjemputan extends Model
{
    use HasFactory;

    protected $primaryKey = 'id';
    protected $table = 'penjemputan';

    protected $fillable = [
        'pasien_id',
        'paramedis_id',
        'lintang',
        'bujur',
    ];

    public function mahasiswa(): HasOne
    {
        return $this->hasOne(Mahasiswa::class, 'id', 'pasien_id');
    }

    public function paramedis(): HasOne
    {
        return $this->hasOne(Paramedis::class, 'id', 'paramedis_id');
    }
}