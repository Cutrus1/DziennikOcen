<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class RoleMiddleware
{
    public function handle($request, Closure $next, ...$roles)
    {
        $user = auth()->user();
    
        // Loguj szczegóły
        Log::info('Sprawdzanie roli użytkownika', [
            'user_id' => $user->id,
            'user_role' => $user->role,
            'required_roles' => $roles,
            'url' => $request->url(),
        ]);
    
        // Sprawdzenie, czy rola użytkownika jest w wymaganych rolach
        if ($user && in_array($user->role, $roles)) {
            return $next($request);
        }
    
        abort(403, 'Nie masz uprawnień do tej strony.');
    }
}
