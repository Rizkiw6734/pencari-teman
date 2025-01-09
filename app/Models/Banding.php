<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Banding extends Model
{
    protected $fillable = [
        'users_id',
        'laporan_id',
        'alasan_banding',
        'status'
    ];

    public function user() {
        return $this->belongsTo(User::class, 'users_id');
    }

    public function laporan() {
        return $this->belongsTo(Laporan::class, 'laporan_id');
    }
}
