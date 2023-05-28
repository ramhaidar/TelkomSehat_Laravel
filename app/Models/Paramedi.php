<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
   @property bigint $user_id user id
@property varchar $username username
@property varchar $kodeParamedis kodeParamedis
@property varchar $nomortelepon nomortelepon
@property timestamp $created_at created at
@property timestamp $updated_at updated at
@property User $user belongsTo
@property \Illuminate\Database\Eloquent\Collection $penjemputan hasMany
@property \Illuminate\Database\Eloquent\Collection $user hasMany
   
 */
class Paramedi extends Model
{

    /**
     * Database table name
     */
    protected $table = 'paramedis';

    /**
     * Mass assignable columns
     */
    protected $fillable = [
        'user_id',
        'username',
        'kodeParamedis',
        'nomortelepon'
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
     * penjemputans
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function penjemputans()
    {
        return $this->hasMany(Penjemputan::class, 'paramedis_id');
    }
    /**
     * users
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function users()
    {
        return $this->hasMany(User::class, 'paramedis_id');
    }



}