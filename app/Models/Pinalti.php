<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class Pinalti extends Model {
    //
    protected $table = 'pinalti';
    protected $fillable = [
        'user_id',
        'jenis_pelanggaran',
        'alasan',
        'bukti',
        'jenis_hukuman',
        'durasi',
        'start_date',
        'end_date',
    ];

    public function user(){
        return $this->belongsTo(User::class, 'user_id');
    }

}
