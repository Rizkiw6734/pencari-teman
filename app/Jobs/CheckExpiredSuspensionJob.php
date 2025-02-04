<?php

namespace App\Jobs;

use App\Models\Pinalti;
use App\Models\Laporan;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;

class CheckExpiredSuspensionJob implements ShouldQueue
{
    use Queueable;

    /**
     * Create a new job instance.
     */
    public function __construct()
    {
        // Tidak ada data yang perlu diteruskan ke job ini, bisa dibiarkan kosong
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $now = Carbon::now();
        $expiredSuspension = Pinalti::where('jenis_hukuman', 'suspend')
            ->where('end_date', '<', $now)->get();

        foreach ($expiredSuspension as $suspend) {
            $user = User::find($suspend->laporan->reported_id);
            $laporan = $suspend->laporan;
            if ($user) {
                $user->status = 'aktif';
                $user->save();
            }
            $suspend->delete();
            $laporan->status = 'selesai';
            $laporan->save();
        }
    }
}
