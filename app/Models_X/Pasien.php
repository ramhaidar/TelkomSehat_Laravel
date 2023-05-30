<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
   @property varchar $username username
@property varchar $nomortelepon nomortelepon
@property bigint $user_id user id
@property timestamp $created_at created at
@property timestamp $updated_at updated at
@property User $user belongsTo
@property \Illuminate\Database\Eloquent\Collection $konsultasi hasMany
@property \Illuminate\Database\Eloquent\Collection $penjemputan hasMany
@property \Illuminate\Database\Eloquent\Collection $reservasi hasMany
@property \Illuminate\Database\Eloquent\Collection $user hasMany
   
 */
class Pasien extends Model
{

    /**
     * Database table name
     */
    protected $table = 'pasien';

    /**
     * Mass assignable columns
     */
    protected $fillable = [
        'username',
        'nomortelepon',
        'user_id'
    ];

    /**
     * Date time columns.
     */
    protected $dates = [];

    /**
     * user
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    /**
     * konsultasis
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function konsultasis()
    {
        return $this->hasMany(Konsultasi::class, 'pasien_id');
    }
    /**
     * penjemputans
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function penjemputans()
    {
        return $this->hasMany(Penjemputan::class, 'pasien_id');
    }
    /**
     * reservasis
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function reservasis()
    {
        return $this->hasMany(Reservasi::class, 'pasien_id');
    }
    /**
     * users
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function users()
    {
        return $this->hasMany(User::class, 'pasien_id');
    }



}