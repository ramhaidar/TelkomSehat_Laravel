<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
   @property bigint $pasien_id pasien id
@property bigint $dokter_id dokter id
@property text $keluhan keluhan
@property text $keterangan keterangan
@property text $jawaban jawaban
@property timestamp $created_at created at
@property timestamp $updated_at updated at
@property Dokter $dokter belongsTo
@property Pasien $pasien belongsTo
   
 */
class Konsultasi extends Model
{

    /**
     * Database table name
     */
    protected $table = 'konsultasi';

    /**
     * Mass assignable columns
     */
    protected $fillable = [
        'pasien_id',
        'dokter_id',
        'keluhan',
        'keterangan',
        'jawaban'
    ];

    /**
     * Date time columns.
     */
    protected $dates = [];

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