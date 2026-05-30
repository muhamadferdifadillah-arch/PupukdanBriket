<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class SecurityHeadersMiddleware
{
    /**
     * Handle an incoming request.
     * Middleware untuk menambahkan security headers yang melindungi dari berbagai jenis serangan
     */
    public function handle(Request $request, Closure $next)
    {
        $response = $next($request);

        // 1. X-Frame-Options: Mencegah Clickjacking Attack
        // DENY = halaman tidak bisa di-embed di frame/iframe manapun
        $response->header('X-Frame-Options', 'DENY');

        // 2. X-Content-Type-Options: Mencegah MIME Type Sniffing
        // nosniff = browser harus menghormati Content-Type yang dikirim server
        $response->header('X-Content-Type-Options', 'nosniff');

        // 3. X-XSS-Protection: Perlindungan XSS untuk browser lama
        // 1; mode=block = enable XSS filter dan block jika XSS terdeteksi
        $response->header('X-XSS-Protection', '1; mode=block');

        // 4. Referrer-Policy: Mengontrol informasi referrer yang dikirim
        // strict-origin-when-cross-origin = hanya kirim origin saat cross-origin
        $response->header('Referrer-Policy', 'strict-origin-when-cross-origin');

        // 5. Content-Security-Policy: Mencegah XSS, Clickjacking, Injection Attack
        // Batasi resource yang boleh di-load dari sumber tertentu
        $csp = "default-src 'self'; " .
               "script-src 'self' 'unsafe-inline' 'unsafe-eval'; " .
               "style-src 'self' 'unsafe-inline'; " .
               "img-src 'self' data: https:; " .
               "font-src 'self'; " .
               "connect-src 'self'; " .
               "frame-ancestors 'none'; " .
               "base-uri 'self'; " .
               "form-action 'self'";
        
        $response->header('Content-Security-Policy', $csp);

        // 6. Strict-Transport-Security: Force HTTPS (Prevent MITM attacks)
        // max-age=31536000 = berlaku 1 tahun, includeSubDomains = berlaku di subdomain juga
        $response->header('Strict-Transport-Security', 'max-age=31536000; includeSubDomains; preload');

        // 7. Permissions-Policy: Kontrol akses ke fitur browser yang sensitive
        // geolocation=(), microphone=() = disable fitur tersebut
        $response->header('Permissions-Policy', 'geolocation=(), microphone=(), camera=(), payment=()');

        return $response;
    }
}
