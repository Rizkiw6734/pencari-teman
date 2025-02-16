<?php
namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use App\Models\User;

class UpdateUserOnlineStatus
{
    public function handle(Request $request, Closure $next)
    {
        if (Auth::check()) {
            $user = Auth::user();
            $now = now();

            // Update last_activity setiap request agar user tetap dianggap online
            $user->update([
                'is_online' => true,
                'last_activity' => $now
            ]);
        }

        return $next($request);
    }
}
