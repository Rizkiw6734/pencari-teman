<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserLog extends Model
{
    protected $table = 'user_logs';
    protected $fillable = ['user_id', 'aktivitas'];

    public function user() {
        return $this->belongsTo(User::class);
    }
}
