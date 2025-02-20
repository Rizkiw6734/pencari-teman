<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class notifikasi extends Model
{
    protected $table = 'notifikasis';

    protected $fillable = [
        'user_id',
        'laporan_id',
        'judul',
        'pesan',
        'link',
        'status'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    /**
     * Relasi ke tabel laporan (jika notifikasi terkait dengan laporan)
     */
    public function laporan()
    {
        return $this->belongsTo(Laporan::class, 'laporan_id');
    }

    /**
     * Scope untuk mengambil hanya notifikasi yang belum dibaca
     */
    public function scopeUnread($query)
    {
        return $query->where('status', 'unread');
    }

    /**
     * Mark notifikasi sebagai read
     */
    public function markAsRead()
    {
        $this->update(['status' => 'read']);
    }
}
