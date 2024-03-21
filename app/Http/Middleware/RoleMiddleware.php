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
            $rolename = Auth::user()->role->name;
            if ($rolename == 'admin' & $role == 'admin') {
                return $next($request);
            }
            if ($rolename == 'manager' & $role == 'manager') {
                return $next($request);
            }
            if ($rolename == 'customer' & $role == 'customer') {
                return $next($request);
            }
        }
        return redirect()->back();
    }
}
