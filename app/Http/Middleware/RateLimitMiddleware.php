<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class RateLimitMiddleware
{
    /**
     * Handle an incoming request.
     * Middleware untuk mencegah Brute Force Attack dengan membatasi request rate
     */
    public function handle(Request $request, Closure $next)
    {
        $key = $this->resolveKey($request);
        
        // Ambil limit dari config atau gunakan default
        $maxAttempts = 60;  // Maksimal 60 requests
        $decayMinutes = 1;  // Per 1 menit
        
        // Untuk login, use stricter limits
        if ($request->is('login', 'register', '*/login', '*/register')) {
            $maxAttempts = 5;   // Maksimal 5 login attempts
            $decayMinutes = 15; // Per 15 menit
        }

        // Untuk API, use moderate limits
        if ($request->is('api/*')) {
            $maxAttempts = 100;
            $decayMinutes = 1;
        }

        // Cek apakah sudah melampaui limit
        if (Cache::has($key)) {
            $attempts = Cache::get($key) ?? 0;
            
            if ($attempts >= $maxAttempts) {
                \Log::warning('Rate limit exceeded', [
                    'ip' => $request->ip(),
                    'path' => $request->path(),
                    'attempts' => $attempts
                ]);
                
                return response()->json([
                    'error' => 'Too many requests. Please try again later.'
                ], 429);
            }

            // Increment attempts
            Cache::increment($key);
        } else {
            // Set initial attempt
            Cache::put($key, 1, $decayMinutes * 60);
        }

        return $next($request);
    }

    /**
     * Resolve request key untuk rate limiting
     * Gunakan kombinasi IP + Path untuk key yang lebih akurat
     */
    private function resolveKey(Request $request): string
    {
        $ip = $request->ip();
        $path = $request->path();
        
        // Jika user authenticated, gunakan user ID
        if (auth()->check()) {
            return 'rate_limit:' . auth()->id() . ':' . $path;
        }

        return 'rate_limit:' . $ip . ':' . $path;
    }
}
