<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Regencies extends Model
{
    protected $table = 'reg_regencies';
    protected $fillable = [
        'province_id',
        'name'
    ];

    public function provinces() {
        return $this->belongsTo(Provinces::class,'province_id');
    }

    public function districts() {
        return $this->hasMany(Districts::class, 'regency_id');
    }

    public function users() {
        return $this->hasMany(User::class, 'kabupaten_id');
    }
}
