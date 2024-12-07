<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Blokir extends Model
{
    //
    protected $table = 'blokirs';
    protected $fillable = [
        'user_id',
        'blocked_user_id',
        'created_at',
    ];
}
