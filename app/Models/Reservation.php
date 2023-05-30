<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Reservation
 *
 * @property int $id
 * @property int|null $patient_id
 * @property int|null $doctor_id
 * @property string $speciality
 * @property Carbon $date
 * @property int $time
 * @property string|null $complaint
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 *
 * @property Doctor|null $doctor
 * @property Patient|null $patient
 *
 * @package App\Models
 */
class Reservation extends Model
{
    protected $_table = 'reservations';

    protected $_casts = [
        'patient_id' => 'int',
        'doctor_id'  => 'int',
        'date'       => 'datetime',
        'time'       => 'int',
    ];

    protected $_fillable = [
        'patient_id',
        'doctor_id',
        'speciality',
        'date',
        'time',
        'complaint',
    ];

    public function doctor()
    {
        return $this->belongsTo(Doctor::class);
    }

    public function patient()
    {
        return $this->belongsTo(Patient::class);
    }
}
