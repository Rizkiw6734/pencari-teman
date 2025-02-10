<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Follower extends Model
{
    protected $table = 'followers';
    protected $fillable = [
        'user_id',
        'follower_id'
    ];

    public function user() {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function follower() {
        return $this->belongsTo(User::class, 'follower_id');
    }
}
