<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Provinces extends Model
{
    protected $table = 'reg_provinces';
    protected $fillable = [
        'name'
    ];

    public function regencies() {
        return $this->hasMany(Regencies::class, 'province_id');
    }
}
