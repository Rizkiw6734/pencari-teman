<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Desa extends Model
{
    //
    protected $table = 'desas';
    protected $fillable = ['kecamatan_id', 'nama_desa', 'latitude', 'longitude'];
}
