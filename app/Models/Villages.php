<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Villages extends Model
{
    protected $table = 'reg_villages';
    protected $fillable = [
        'district_id',
        'name'
    ];

    public function districts() {
        return $this->belongsTo(Districts::class, 'district_id');
    }

    public function users() {
        return $this->hasMany(User::class, 'desa_id');
    }
}
