<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pesan extends Model {
    //
    protected $table = 'pesans';
    protected $fillable = [
        'user_id',
        'message',
        'is_read',
        'created_at',

    ];
}
