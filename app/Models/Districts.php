<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Districts extends Model
{
    protected $table = 'reg_districts';
    protected $fillable = [
        'regency_id',
        'name'
    ];

    public function regencies() {
        return $this->belongsTo(Regencies::class, 'regency_id');
    }

    public function villages() {
        return $this->hasMany(Villages::class, 'district_id');
    }

    public function users() {
        return $this->hasMany(User::class, 'kecamatan_id');
    }
}
