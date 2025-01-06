<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Alumni extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'alumni';

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = ['nama', 'no_absen', 'no_reg', 'tempat_lahir', 'tanggal_lahir', 'photo', 'pelaksaan_diklat_id'];

    /**
     * The attributes that should be cast.
     *
     * @var string[]
     */
    protected $casts = ['nama' => 'string', 'no_absen' => 'integer', 'no_reg' => 'integer', 'tempat_lahir' => 'string', 'tanggal_lahir' => 'date:Y-m-d', 'photo' => 'string', 'created_at' => 'datetime:Y-m-d H:i:s', 'updated_at' => 'datetime:Y-m-d H:i:s'];


    public function pelaksaan_diklat()
    {
        return $this->belongsTo(\App\Models\PelaksaanDiklat::class);
    }
}
