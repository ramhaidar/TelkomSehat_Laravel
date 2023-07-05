<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Doctor
 *
 * @property int $id
 * @property string $doctor_code
 * @property string $username
 * @property string $phone_number
 * @property string $speciality
 * @property int|null $user_id
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 *
 * @property User|null $user
 * @property Collection|Consultation[] $consultations
 * @property Collection|Reservation[] $reservations
 * @property Collection|User[] $users
 *
 * @package App\Models
 */
class Doctor extends Model
{
    protected $table = 'doctors';

    protected $casts = [ 
        'user_id' => 'int',
    ];

    protected $fillable = [ 
        'doctor_code',
        'username',
        'phone_number',
        'speciality',
        'user_id',
    ];

    public function user ()
    {
        return $this->belongsTo ( User::class);
    }

    public function consultations ()
    {
        return $this->hasMany ( Consultation::class);
    }

    public function reservations ()
    {
        return $this->hasMany ( Reservation::class);
    }

    public function users ()
    {
        return $this->hasMany ( User::class);
    }
}