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
        'created_at',
        'updated_at',
    ];
}
