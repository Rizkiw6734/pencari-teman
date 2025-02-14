<?php
namespace App\Models;
use App\Models\User;
use App\Models\Pinalti;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AdminLog extends Model
{
    use HasFactory;

    protected $table = 'admin_logs';

    public $timestamps = false;

    protected $fillable = [
        'users_id',
        'pinalti_id',
        'jenis_hukuman',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'users_id');
    }

    public function pinalti()
    {
        return $this->belongsTo(Pinalti::class, 'pinalti_id');
    }
}
