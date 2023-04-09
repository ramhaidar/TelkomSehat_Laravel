<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mahasiswa extends Model
{
    use HasFactory;

    protected $primaryKey = 'id';
    protected $table = 'mahasiswa';

    protected $fillable = [
        'nim',
        'username',
        'nomortelepon',
    ];
}