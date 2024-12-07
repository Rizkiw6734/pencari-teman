<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Laporan extends Model {
    //
    protected $table = 'laporan';
    protected $fillable = [
        'report_id',
        'reported_id',
    ];

    public function pelapor(){
        return $this->belongsTo(User::class, 'report_id');
    }

    public function terlapor(){
        return $this->belongsTo(User::class, 'reported_id');
    }
}
