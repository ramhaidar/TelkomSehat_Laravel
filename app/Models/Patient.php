<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Patient
 *
 * @property int $id
 * @property string $username
 * @property string $phone_number
 * @property int|null $user_id
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 *
 * @property User|null $user
 * @property Collection|Consultation[] $consultations
 * @property Collection|Evacuation[] $evacuations
 * @property Collection|Reservation[] $reservations
 * @property Collection|User[] $users
 *
 * @package App\Models
 */
class Patient extends Model
{
    protected $_table = 'patients';

    protected $_casts = [
        'user_id' => 'int',
    ];

    protected $_fillable = [
        'username',
        'phone_number',
        'user_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function consultations()
    {
        return $this->hasMany(Consultation::class);
    }

    public function evacuations()
    {
        return $this->hasMany(Evacuation::class);
    }

    public function reservations()
    {
        return $this->hasMany(Reservation::class);
    }

    public function users()
    {
        return $this->hasMany(User::class);
    }
}
