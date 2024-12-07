<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Desa extends Model
{
    //
    protected $table = 'desa';
    protected $fillable = [
        'nama',
        'kecamatan_id',
        'latitude',
        'longitude'
    ];

    public function kecamatan(){
        return $this->belongsTo(Kecamatan::class, 'kecamatan_id');
    }
}
