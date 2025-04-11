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
        if (Auth::guard('admin')->check() && Auth::guard('admin')->user()->role == 'superadmin') {
            return $next($request);
        }


        if (Auth::guard('admin')->check() && Auth::guard('admin')->user()->role == 'admin') {
            if (in_array($request->route()->getActionMethod(), ['create', 'edit', 'destroy'])) {
                // return redirect()->route('admins.show', Auth::guard('admin')->user()->id); 
                abort(403, 'You do not have sufficient permissions to access this page.');
            }
        }

        return $next($request);
    }
}
