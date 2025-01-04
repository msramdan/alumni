<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class alumni extends Model
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
    protected $fillable = ['no_reg', 'nama', 'tempat_lahir', 'tanggal_lahir'];

    /**
     * The attributes that should be cast.
     *
     * @var string[]
     */
    protected $casts = ['no_reg' => 'integer', 'nama' => 'string', 'tempat_lahir' => 'string', 'tanggal_lahir' => 'date:Y-m-d', 'created_at' => 'datetime:Y-m-d H:i:s', 'updated_at' => 'datetime:Y-m-d H:i:s'];


}
