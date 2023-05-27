<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Models\Pasien;
use App\Models\Paramedis;
use App\Models\Dokter;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'pasien_id',
        'dokter_id',
        'mobile_app_token',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function pasien(): HasOne
    {
        return $this->hasOne(Pasien::class, 'id', 'pasien_id');
    }

    public function dokter(): HasOne
    {
        return $this->hasOne(Dokter::class, 'id', 'dokter_id');
    }

    public function paramedis(): HasOne
    {
        return $this->hasOne(Paramedis::class, 'id', 'paramedis_id');
    }
}