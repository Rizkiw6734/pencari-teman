<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class Pinalti extends Model {
    //
    protected $table = 'pinalti';
    protected $fillable = [
        'laporan_id',
        'jenis_hukuman',
        'pesan',
        'durasi',
        'start_date',
        'end_date',
    ];

    public function laporan() {
        return $this->belongsTo(Laporan::class, 'laporan_id');
    }

    public function banding() {
        return $this->hasOne(Banding::class, 'pinalti_id');
    }

    public function adminLog()
    {
        return $this->hasOne(AdminLog::class, 'pinalti_id');
    }
}
