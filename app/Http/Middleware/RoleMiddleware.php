<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next,$role = null): Response
    {
        if (Auth::check()) {
            $user = Auth::user()->role_type;
            if ($user == 1 & $role == 'admin') {
                return $next($request);
            }
        }
        return redirect()->back();
    }
}
