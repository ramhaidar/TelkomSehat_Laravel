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
        'mahasiswaid',
        'paramedisid',
        'lintang',
        'bujur',
    ];

    public function mahasiswa(): HasOne
    {
        return $this->hasOne(Mahasiswa::class, 'id', 'mahasiswaid');
    }

    public function paramedis(): HasOne
    {
        return $this->hasOne(Paramedis::class, 'id', 'paramedisid');
    }
}