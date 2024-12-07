<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pertemanan extends Model {
    //
    protected $table = 'pertemanans';
    protected $fillable = [
        'pengirim_id',
        'penerima_id',
        'status',
        'created_at',
        'updated_at' ];
    }
