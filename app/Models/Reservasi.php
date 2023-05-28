<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
   @property bigint $pasien_id pasien id
@property bigint $dokter_id dokter id
@property varchar $spesialis spesialis
@property date $tanggal tanggal
@property int $waktu waktu
@property text $keluhan keluhan
@property timestamp $created_at created at
@property timestamp $updated_at updated at
@property Dokter $dokter belongsTo
@property Pasien $pasien belongsTo
   
 */
class Reservasi extends Model
{

    /**
     * Database table name
     */
    protected $table = 'reservasi';

    /**
     * Mass assignable columns
     */
    protected $fillable = [
        'pasien_id',
        'dokter_id',
        'spesialis',
        'tanggal',
        'waktu',
        'keluhan'
    ];

    /**
     * Date time columns.
     */
    protected $dates = ['tanggal'];

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




}