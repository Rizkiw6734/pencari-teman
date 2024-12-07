<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pertemanan extends Model
{
    protected $table = 'pertemanan';
    protected $fillable = [
        'pengirim_id',
        'penerima_id',
        'status',
    ];

    public function
}
