<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsureAdminAuthenticated
{
    public function handle(Request $request, Closure $next): Response
    {
        $user = $request->user();

        if (!$user || !$user->is_admin) {
            if ($request->expectsJson()) {
                return response()->json([
                    'message' => 'Unauthenticated admin session.',
                ], 401);
            }
            return redirect()->route('admin.login');
        }

        return $next($request);
    }
}
