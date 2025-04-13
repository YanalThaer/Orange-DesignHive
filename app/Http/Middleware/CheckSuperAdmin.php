<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class CheckSuperAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $admin = Auth::guard('admin')->user();

        // إذا مو مسجل أصلاً
        if (!$admin) {
            return redirect('/'); // أو abort(403)
        }

        // إذا superadmin، خليه يكمل
        if ($admin->role === 'superadmin') {
            return $next($request);
        }

        // باقي الحالات، امنع
        abort(403, 'You do not have sufficient permissions to access this page.');
    }
}
