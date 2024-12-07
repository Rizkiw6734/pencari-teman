<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Kecamatan extends Model
{
    //
    protected $table = 'kecamatan';
    protected $fillable = [
        'nama',
        'kabupaten_id',
    ];

    public function kabupaten(){
        return $this->belongsTo(Kabupaten::class, 'kabupaten_id');
    }

    public function desa(){
        return $this->hasMany(Desa::class, 'kecamatan_id');
    }

}

