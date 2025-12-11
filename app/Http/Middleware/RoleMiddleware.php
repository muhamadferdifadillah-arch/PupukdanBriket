<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class RoleMiddleware
{
    public function handle(Request $request, Closure $next, string $role): Response
    {
        // Jika user belum login, redirect ke halaman login yang sesuai
        if (!Auth::check()) {
            if ($role === 'admin') {
                return redirect()->route('admin.login');
            } elseif ($role === 'produsen') {
                return redirect()->route('produsen.login');
            }
            return redirect()->route('user.login');
        }

        // Jika role tidak sesuai, tampilkan error 403
        if (Auth::user()->role !== $role) {
            abort(403, 'Akses ditolak. Role Anda: ' . (Auth::user()->role ?? 'null') . ', Required: ' . $role);
        }

        return $next($request);
    }
}