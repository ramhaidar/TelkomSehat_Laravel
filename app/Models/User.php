<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
  @property varchar $name name
@property varchar $email email
@property timestamp $email_verified_at email verified at
@property varchar $password password
@property bigint $pasien_id pasien id
@property bigint $dokter_id dokter id
@property bigint $paramedis_id paramedis id
@property varchar $remember_token remember token
@property varchar $mobile_app_token mobile app token
@property timestamp $created_at created at
@property timestamp $updated_at updated at
@property Paramedi $paramedi belongsTo
@property Dokter $dokter belongsTo
@property Pasien $pasien belongsTo
@property \Illuminate\Database\Eloquent\Collection $dokter hasMany
@property \Illuminate\Database\Eloquent\Collection $paramedi hasMany
@property \Illuminate\Database\Eloquent\Collection $pasien hasMany
   
 */
class User extends Model
{

    /**
     * Database table name
     */
    protected $table = 'users';

    /**
     * Mass assignable columns
     */
    protected $fillable = [
        'name',
        'email',
        'email_verified_at',
        'pasien_id',
        'dokter_id',
        'paramedis_id',
        'mobile_app_token'
    ];

    /**
     * Date time columns.
     */
    protected $dates = ['email_verified_at'];

    /**
     * paramedi
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function paramedi()
    {
        return $this->belongsTo(Paramedi::class, 'paramedis_id');
    }

    /**
     * dokter
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function dokter()
    {
        return $this->belongsTo(Dokter::class, 'dokter_id');
    }

    /**
     * pasien
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function pasien()
    {
        return $this->belongsTo(Pasien::class, 'pasien_id');
    }

    /**
     * dokters
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function dokters()
    {
        return $this->hasMany(Dokter::class, 'user_id');
    }
    /**
     * paramedis
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function paramedis()
    {
        return $this->hasMany(Paramedi::class, 'user_id');
    }
    /**
     * pasiens
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function pasiens()
    {
        return $this->hasMany(Pasien::class, 'user_id');
    }



}