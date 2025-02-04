<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Banding extends Model
{
    protected $table = 'banding';
    protected $fillable = [
        'users_id',
        'pinalti_id',
        'jenis_hukuman',
        'alasan_banding',
        'status'
    ];

    public function user() {
        return $this->belongsTo(User::class, 'users_id');
    }

    public function pinalti() {
        return $this->belongsTo(Pinalti::class, 'pinalti_id');
    }
}
