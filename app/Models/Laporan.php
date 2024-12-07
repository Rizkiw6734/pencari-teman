<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Laporan extends Model {
    //
    protected $table = 'laporans';
    protected $fillable = [
        'report_id',
        'reported_id',
        'bukti',
        'alasan',
        'status',
        'created_at'
    ];
}
