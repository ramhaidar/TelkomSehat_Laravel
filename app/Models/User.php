<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Foundation\Auth\User as Authenticatable;

/**
 * Class User
 *
 * @property int $id
 * @property string $name
 * @property string|null $email
 * @property Carbon|null $email_verified_at
 * @property string $password
 * @property int|null $patient_id
 * @property int|null $doctor_id
 * @property int|null $paramedic_id
 * @property string|null $remember_token
 * @property string|null $mobile_app_token
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 *
 * @property Doctor|null $doctor
 * @property Patient|null $patient
 * @property Paramedic|null $paramedic
 * @property Collection|Doctor[] $doctors
 * @property Collection|Paramedic[] $paramedics
 * @property Collection|Patient[] $patients
 *
 * @package App\Models
 */
class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $table = 'users';

    protected $casts = [ 
        'email_verified_at' => 'datetime',
        'patient_id'        => 'int',
        'doctor_id'         => 'int',
        'paramedic_id'      => 'int',
    ];

    protected $hidden = [ 
        'password',
        'remember_token',
        'mobile_app_token',
    ];

    protected $fillable = [ 
        'name',
        'email',
        'email_verified_at',
        'password',
        'patient_id',
        'doctor_id',
        'paramedic_id',
        'remember_token',
        'mobile_app_token',
    ];

    public function doctor ()
    {
        return $this->belongsTo ( Doctor::class);
    }

    public function patient ()
    {
        return $this->belongsTo ( Patient::class);
    }

    public function paramedic ()
    {
        return $this->belongsTo ( Paramedic::class);
    }

    public function doctors ()
    {
        return $this->hasMany ( Doctor::class);
    }

    public function paramedics ()
    {
        return $this->hasMany ( Paramedic::class);
    }

    public function patients ()
    {
        return $this->hasMany ( Patient::class);
    }
}