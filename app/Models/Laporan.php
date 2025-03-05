<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Laporan extends Model {
    //
    protected $table = 'laporan';
    protected $fillable = [
        'report_id',
        'reported_id',
        'bukti',
        'pelanggaran',
        'alasan',
        'status'
    ];

    public function pelapor2()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function pelapor(){
        return $this->belongsTo(User::class, 'report_id');
    }

    public function terlapor(){
        return $this->belongsTo(User::class, 'reported_id');
    }

    public function pinalti() {
        return $this->HasOne(Pinalti::class, 'laporan_id');
    }

    public function notifikasi()
{
    return $this->hasMany(notifikasi::class, 'laporan_id');
}

}
