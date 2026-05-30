<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CorsSecurityMiddleware
{
    /**
     * Handle CORS requests dengan security yang ketat
     * CORS (Cross-Origin Resource Sharing) bisa menjadi vektor attack jika tidak dikonfigurasi dengan benar
     */
    public function handle(Request $request, Closure $next)
    {
        // Allowed origins (domains yang boleh akses API)
        $allowedOrigins = [
            'http://localhost:3000',
            'http://localhost:8000',
            env('APP_URL', 'http://localhost'),
            // Tambahkan domain production Anda
        ];

        $origin = $request->header('Origin');

        // Cek apakah origin adalah allowed origin
        if (in_array($origin, $allowedOrigins)) {
            $response = $next($request);
            
            $response->header('Access-Control-Allow-Origin', $origin);
            $response->header('Access-Control-Allow-Credentials', 'true');
            $response->header('Access-Control-Allow-Methods', 'GET, POST, PUT, DELETE, OPTIONS, PATCH');
            $response->header('Access-Control-Allow-Headers', 'Content-Type, Authorization, X-Requested-With, X-CSRF-Token');
            $response->header('Access-Control-Max-Age', '86400'); // 24 hours

            return $response;
        }

        // Preflight request
        if ($request->isMethod('OPTIONS')) {
            return response('', 200);
        }

        return $next($request);
    }
}
