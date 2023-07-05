<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Consultation
 *
 * @property int $id
 * @property int|null $patient_id
 * @property int|null $doctor_id
 * @property string|null $complaint
 * @property string|null $annotation
 * @property string|null $answer
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 *
 * @property Doctor|null $doctor
 * @property Patient|null $patient
 *
 * @package App\Models
 */
class Consultation extends Model
{
    protected $table = 'consultations';

    protected $casts = [ 
        'patient_id' => 'int',
        'doctor_id'  => 'int',
    ];

    protected $fillable = [ 
        'patient_id',
        'doctor_id',
        'complaint',
        'annotation',
        'answer',
    ];

    public function doctor ()
    {
        return $this->belongsTo ( Doctor::class);
    }

    public function patient ()
    {
        return $this->belongsTo ( Patient::class);
    }
}