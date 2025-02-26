<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Rating extends Model
{
    protected $fillable = ['user_id', 'rating', 'ulasan', 'status']; // Kolom yang bisa diisi

    // Relasi ke model User
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
