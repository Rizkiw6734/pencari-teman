<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Chat extends Model {
    //
    protected $table = 'chat';
    protected $fillable = [
        'pengirim_id',
        'penerima_id',
        'konten',
        'status',
        'created_at'
    ];

    public function pengirim(){
        return $this->belongsTo(User::class, 'pengirim_id');
    }

    public function penerima(){
        return $this->belongsTo(User::class, 'penerima_id');
    }
}
