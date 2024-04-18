<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class Permission
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, $category = null): Response
    {
        if (Auth::check()) {
            $user_permission = Auth::user()->role->permissions->toArray();
            foreach ($user_permission as $value) {
                if ($value['category'] == $category) {
                    return $next($request);
                }
            }
        }
        return redirect()->back();
    }
}
