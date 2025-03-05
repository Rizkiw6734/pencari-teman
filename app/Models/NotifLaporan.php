<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NotifLaporan extends Model
{
    use HasFactory;

    /**
     * Kolom yang dapat diisi (fillable) secara massal.
     *
     * @var array
     */
    protected $table = 'notif_laporans';
    protected $fillable = [
        'user_id',
        'type',
        'message',
        'is_read',
        'link',
    ];

    /**
     * Kolom yang harus disembunyikan saat di-serialize (misalnya, di JSON).
     *
     * @var array
     */
    protected $hidden = [
        'updated_at', // Sembunyikan kolom updated_at
    ];

    /**
     * Relasi ke model User.
     * Setiap notifikasi dimiliki oleh satu user.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Scope untuk mengambil notifikasi yang belum dibaca.
     */
    public function scopeUnread($query)
    {
        return $query->where('is_read', false);
    }

    /**
     * Scope untuk mengambil notifikasi yang sudah dibaca.
     */
    public function scopeRead($query)
    {
        return $query->where('is_read', true);
    }

    /**
     * Scope untuk mengambil notifikasi berdasarkan user ID.
     */
    public function scopeForUser($query, $userId)
    {
        return $query->where('user_id', $userId);
    }
}
