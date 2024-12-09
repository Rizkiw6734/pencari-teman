<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasFactory, Notifiable, HasRoles; // Tambahkan HasRoles dari Spatie

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'bio',
        'desa_id',
        'hobi',
        'ktp',
        'umur',
        'gender',
        'foto_profil',
        'status',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    /**
     * Relationship: Pinalti yang terkait dengan pengguna.
     */
    public function pinalti()
    {
        return $this->hasMany(Pinalti::class, 'user_id');
    }

    /**
     * Relationship: Pesan yang diterima oleh pengguna.
     */
    public function pesanDiterima()
    {
        return $this->hasMany(Pesan::class, 'penerima_id');
    }

    /**
     * Relationship: Pertemanan yang dikirim oleh pengguna.
     */
    public function pertemananTerkirim()
    {
        return $this->hasMany(Pertemanan::class, 'pengirim_id');
    }

    /**
     * Relationship: Pertemanan yang diterima oleh pengguna.
     */
    public function pertemananDiterima()
    {
        return $this->hasMany(Pertemanan::class, 'penerima_id');
    }

    /**
     * Relationship: Laporan yang dibuat oleh pengguna.
     */
    public function laporanDibuat()
    {
        return $this->hasMany(Laporan::class, 'report_id');
    }

    /**
     * Relationship: Laporan yang diterima oleh pengguna.
     */
    public function laporanDiterima()
    {
        return $this->hasMany(Laporan::class, 'reported_id');
    }

    /**
     * Relationship: Chat yang dikirim oleh pengguna.
     */
    public function chatDikirim()
    {
        return $this->hasMany(Chat::class, 'pengirim_id');
    }

    /**
     * Relationship: Chat yang diterima oleh pengguna.
     */
    public function chatDiterima()
    {
        return $this->hasMany(Chat::class, 'penerima_id');
    }

    /**
     * Relationship: Blokir yang dilakukan oleh pengguna.
     */
    public function blokir()
    {
        return $this->hasMany(Blokir::class, 'users_id');
    }

    /**
     * Relationship: Blokir yang diterima oleh pengguna.
     */
    public function diblokirOleh()
    {
        return $this->hasMany(Blokir::class, 'blocked_user_id');
    }
}
