<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Kabupaten extends Model
{
    protected $table = 'kabupaten';
    protected $fillable = [
        'nama',
        'provinsi_id',
    ];

    public function provinsi(){
        return $this->belongsTo(Provinsi::class, 'provinsi_id');
    }

    public function kecamatan(){
        return $this->hasMany(Kecamatan::class, 'kabupaten_id');
    }
}
