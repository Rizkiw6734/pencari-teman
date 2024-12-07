<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Chat extends Model {
    //
    protected $table = 'chats';
    protected $fillable = [
        'pengirim_id',
        'penerima_id',
        'konten',
    ];

    public function pengirim(){
        return $this->belongsTo(User::class, 'user_id');
    }

    public function penerima(){
        return $this->belongsTo(User::class, 'penerima_id');
    }
}
