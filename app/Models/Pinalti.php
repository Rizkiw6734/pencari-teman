<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pinalti extends Model {
    //
    protected $table = 'pinaltis';
    protected $fillable = [
        'jenis_pelanggaran',
        'alasan',
        'bukti',
        'jenis_hukuman',
        'durasi',
        'start_date',
        'end_date',
        'created_at',
        'updated_at',
    ];
}
