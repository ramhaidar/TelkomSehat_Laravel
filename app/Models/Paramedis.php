<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Paramedis extends Model
{
    use HasFactory;

    protected $primaryKey = 'id';
    protected $table = 'paramedis';

    protected $fillable = [
        'username',
        'kodeParamedis',
        'nomortelepon',
        'userid',
    ];

    public function user(): HasOne
    {
        return $this->hasOne(User::class, 'id', 'userid');
    }
}