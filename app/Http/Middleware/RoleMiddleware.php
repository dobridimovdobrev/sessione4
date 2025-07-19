<?php

namespace App\Http\Middleware;

use App\Helpers\ResponseMessages;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class RoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, ...$roles)
    {
        // Check if the user is authenticated 
        $authenticatedUser = Auth::user();

        //if their role matches the required role
        if ($authenticatedUser && in_array($authenticatedUser->role->role_name, $roles)) {
           
            return $next($request);
        }

        //  return a 403 Forbidden 
        return ResponseMessages::error('Unauthorized', 403);
    }
}
