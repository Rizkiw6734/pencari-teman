<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;
use Laravel\Sanctum\HasApiTokens;  //

class User extends Authenticatable
{
    use HasFactory, Notifiable, HasRoles, HasApiTokens; // Tambahkan HasRoles dari Spatie

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'last_name',
        'email',
        'password',
        'bio',
        'hobi',
        'umur',
        'gender',
        'foto_profil',
        'status',
        'provinsi_id',
        'kabupaten_id',
        'kecamatan_id',
        'desa_id',
        'latitude',
        'longitude',
        'is_online',
        'last_activity'
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
    public function blokiran()
    {
        return $this->hasMany(Blokir::class, 'users_id');
    }

    /**
     * Relationship: Blokir yang diterima oleh pengguna.
     */
    public function diblokir()
    {
        return $this->hasMany(Blokir::class, 'blocked_user_id');
    }

    public function banding()
    {
        return $this->hasone(Banding::class, 'users_id');
    }

    public function adminLog()
    {
        return $this->hasOne(AdminLog::class, 'user_id');
    }

    public function provinsis() {
        return $this->belongsTo(Provinces::class, 'provinsi_id');
    }

    public function kabupatens() {
        return $this->belongsTo(Regencies::class, 'kabupaten_id');
    }

    public function kecamatans() {
        return $this->belongsTo(Districts::class, 'kecamatan_id');
    }

    public function desas() {
        return $this->belongsTo(Villages::class, 'desa_id');
    }

    public function followers() {
        return $this->hasMany(Follower::class, 'user_id');
    }

    public function following() {
        return $this->hasMany(Follower::class, 'follower_id');
    }

    public function isFollowing(User $user)
{
    return $this->following()->where('user_id', $user->id)->exists();
}

public function notifikasi()
{
    return $this->hasMany(notifikasi::class, 'user_id');
}


}
