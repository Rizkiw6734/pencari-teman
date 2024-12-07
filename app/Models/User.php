<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
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
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function pinalti(){
        return $this->hasMany(Pinalti::class, 'user_id');
    }

    public function pesanDiterima(){
        return $this->hasMany(Pesan::class, 'penerima_id');
    }

    public function pertemananTerkirim(){
        return $this->hasMany(Pertemanan::class, 'pengirim_id');
    }

    public function pertemananDiterima(){
        return $this->hasMany(Pertemanan::class, 'penerima_id');
    }

    public function laporanDibuat(){
        return $this->hasMany(Laporan::class, 'report_id');
    }

    public function laporanDiterima(){
        return $this->hasMany(Laporan::class, 'reported_id');
    }

    public function chatDikirim(){
        return $this->hasMany(Chat::class, 'pengirim_id');
    }

    public function chatDiterima(){
        return $this->hasMany(Chat::class, 'penerima_id');
    }

    public function blokir(){
        return $this->hasMany(Blokir::class, 'users_id');
    }

    public function diblokirOleh(){
        return $this->hasMany(Blokir::class, 'blocked_user_id');
    }
}
