<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
   @property bigint $pasien_id pasien id
@property bigint $paramedis_id paramedis id
@property varchar $lintang lintang
@property varchar $bujur bujur
@property tinyint $selesai selesai
@property timestamp $created_at created at
@property timestamp $updated_at updated at
@property Paramedi $paramedi belongsTo
@property Pasien $pasien belongsTo
   
 */
class Penjemputan extends Model
{

    /**
     * Database table name
     */
    protected $table = 'penjemputan';

    /**
     * Mass assignable columns
     */
    protected $fillable = [
        'pasien_id',
        'paramedis_id',
        'lintang',
        'bujur',
        'selesai'
    ];

    /**
     * Date time columns.
     */
    protected $dates = [];

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
     * pasien
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function pasien()
    {
        return $this->belongsTo(Pasien::class, 'pasien_id');
    }




}