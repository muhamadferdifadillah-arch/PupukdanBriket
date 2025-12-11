<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class AdminMiddleware
{
    public function handle($request, Closure $next)
    {
        // Jika belum login → redirect ke login admin
        if (!Auth::check()) {
            return redirect()->route('admin.login');
        }

        // Jika role user bukan admin → 403
        if (Auth::user()->role !== 'admin') {
            abort(403, 'ANDA TIDAK MEMILIKI IZIN UNTUK MENGAKSES HALAMAN INI.');
        }

        return $next($request);
    }
}
