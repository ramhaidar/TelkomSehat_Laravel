<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Paramedic
 *
 * @property int $id
 * @property int|null $user_id
 * @property string $username
 * @property string $paramedic_code
 * @property string $phone_number
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 *
 * @property User|null $user
 * @property Collection|Evacuation[] $evacuations
 * @property Collection|User[] $users
 *
 * @package App\Models
 */
class Paramedic extends Model
{
    protected $table = 'paramedics';

    protected $casts = [ 
        'user_id' => 'int',
    ];

    protected $fillable = [ 
        'user_id',
        'username',
        'paramedic_code',
        'phone_number',
    ];

    public function user ()
    {
        return $this->belongsTo ( User::class);
    }

    public function evacuations ()
    {
        return $this->hasMany ( Evacuation::class);
    }

    public function users ()
    {
        return $this->hasMany ( User::class);
    }
}