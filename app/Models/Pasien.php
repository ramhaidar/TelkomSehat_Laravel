<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Pasien extends Model
{
    use HasFactory;

    protected $primaryKey = 'id';
    protected $table = 'pasien';

    protected $fillable = [
        'nim',
        'username',
        'nomortelepon',
        'userid',
    ];

    public function user(): HasOne
    {
        return $this->hasOne(User::class, 'id', 'userid');
    }
}