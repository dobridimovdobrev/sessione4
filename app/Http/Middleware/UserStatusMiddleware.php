<?php

namespace App\Http\Middleware;

use App\Helpers\ResponseMessages;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserStatusMiddleware
{
    /**
     * Handle an incoming request.
     * Check if authenticated user has active status
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next)
    {
        // Check if user is authenticated
        $user = Auth::user();
        
        if ($user) {
            // Check user status
            if ($user->user_status !== 'active') {
                $statusMessages = [
                    'inactive' => 'Account temporaneamente disabilitato. Contatta l\'amministratore.',
                    'banned' => 'Account bannato permanentemente. Accesso negato.'
                ];
                
                $message = $statusMessages[$user->user_status] ?? 'Account non attivo';
                return ResponseMessages::error($message, 403);
            }
        }

        return $next($request);
    }
}
