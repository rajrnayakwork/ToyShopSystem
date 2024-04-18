<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Symfony\Component\HttpFoundation\Response;

use function Laravel\Prompts\alert;

class RoleOrPermission
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, $permission = null): Response
    {
            $user_permission = Auth::user()->role->permissions->toArray();
            foreach ($user_permission as $value) {
                if ($value['name'] == $permission) {
                    return $next($request);
                }
            }
        return abort(404);
    }
}
