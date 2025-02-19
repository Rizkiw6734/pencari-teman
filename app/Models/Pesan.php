<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pesan extends Model {
    //
    protected $table = 'pesan';
    protected $fillable = [
        'penerima_id',
        'konten',
        'is_read',
    ];

    public function penerima(){
        return $this->belongsTo(User::class, 'penerima_id');
    }
}
