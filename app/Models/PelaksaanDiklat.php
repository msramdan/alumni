<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PelaksaanDiklat extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'pelaksaan_diklats';

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = ['diklat_id', 'angkatan', 'tanggal_mulai', 'tanggal_selesai', 'kota', 'provinsi'];

    /**
     * The attributes that should be cast.
     *
     * @var string[]
     */
    protected $casts = ['angkatan' => 'string', 'tanggal_mulai' => 'date:Y-m-d', 'tanggal_selesai' => 'date:Y-m-d', 'kota' => 'string', 'provinsi' => 'string', 'created_at' => 'datetime:Y-m-d H:i:s', 'updated_at' => 'datetime:Y-m-d H:i:s'];


    public function diklat()
    {
        return $this->belongsTo(\App\Models\Diklat::class);
    }
}
