<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class AdminMiddleware
{
    public function handle(Request $request, Closure $next): Response
    {
        // Get the authenticated user
        $user = Auth::user();

        // Check eza el user logged in WA el role admin
        // Sta3malna optional chaining (?) krmal el safety
        if ($user && $user->role === 'admin') {
            return $next($request);
        }

        return response()->json([
            'status' => false,
            'message' => 'Access Denied! You do not have admin privileges.',
        ], 403);
    }
}