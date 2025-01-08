<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Models\Pinalti;
use App\Models\User;
use Carbon\Carbon;

class CheckExpiredSuspension
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $now = Carbon::now();
        $expiredSuspension = Pinalti::where('jenis_hukuman', 'suspend')
            ->where('end_date', '<', $now)->get();

        foreach ($expiredSuspension as $suspend) {
            $user = User::find($suspend->laporan->reported_id);
            if ($user) {
                $user->status = 'aktif';
                $user->save();
            }
            $suspend->delete();
        }

        return $next($request);
    }
}
