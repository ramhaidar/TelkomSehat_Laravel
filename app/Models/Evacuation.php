<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Evacuation
 *
 * @property int $id
 * @property int|null $patient_id
 * @property int|null $paramedic_id
 * @property string $latitude
 * @property string $longitude
 * @property bool $is_done
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 *
 * @property Patient|null $patient
 * @property Paramedic|null $paramedic
 *
 * @package App\Models
 */
class Evacuation extends Model
{
    protected $_table = 'evacuations';

    protected $_casts = [
        'patient_id'   => 'int',
        'paramedic_id' => 'int',
        'is_done'      => 'bool',
    ];

    protected $_fillable = [
        'patient_id',
        'paramedic_id',
        'latitude',
        'longitude',
        'is_done',
    ];

    public function patient()
    {
        return $this->belongsTo(Patient::class);
    }

    public function paramedic()
    {
        return $this->belongsTo(Paramedic::class);
    }
}
