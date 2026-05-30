<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class InputValidationMiddleware
{
    /**
     * Handle an incoming request.
     * Middleware untuk validasi input dan mencegah XSS attack
     */
    public function handle(Request $request, Closure $next)
    {
        // Skip CSRF check untuk method GET
        if ($request->isMethod('get')) {
            return $next($request);
        }

        // Validasi semua input request parameter
        $this->validateInputs($request);

        return $next($request);
    }

    /**
     * Validasi input untuk mencegah malicious code
     */
    private function validateInputs(Request $request)
    {
        $rules = [];
        
        // Dapatkan semua input
        $inputs = $request->all();

        // Validasi setiap input untuk mencegah XSS dan SQL Injection
        foreach ($inputs as $key => $value) {
            if (is_string($value)) {
                // Validasi string input
                $rules[$key] = 'nullable|string|max:5000';
                
                // Check for common XSS patterns
                $this->checkXSSPatterns($key, $value);
                
                // Check for SQL Injection patterns
                $this->checkSQLInjectionPatterns($key, $value);
            } elseif (is_array($value)) {
                // Handle array inputs
                $rules[$key] = 'nullable|array';
            }
        }

        // Jalankan validasi
        if (!empty($rules)) {
            $request->validate($rules);
        }
    }

    /**
     * Deteksi XSS pattern umum
     */
    private function checkXSSPatterns($key, $value)
    {
        // Pattern XSS yang berbahaya
        $xssPatterns = [
            '/<script[^>]*>.*?<\/script>/i',
            '/javascript:/i',
            '/on\w+\s*=/i',  // onload=, onclick=, etc
            '/<iframe[^>]*>/i',
            '/<object[^>]*>/i',
            '/<embed[^>]*>/i',
            '/eval\(/i',
        ];

        foreach ($xssPatterns as $pattern) {
            if (preg_match($pattern, $value)) {
                \Log::warning('XSS attempt detected', [
                    'parameter' => $key,
                    'value' => substr($value, 0, 50),
                    'ip' => request()->ip(),
                    'timestamp' => now()
                ]);
                
                abort(400, 'Invalid input detected');
            }
        }
    }

    /**
     * Deteksi SQL Injection pattern umum
     */
    private function checkSQLInjectionPatterns($key, $value)
    {
        // Pattern SQL Injection yang berbahaya
        $sqlPatterns = [
            '/(\bUNION\b.*\bSELECT\b)/i',
            '/(\bDROP\b.*\bTABLE\b)/i',
            '/(\bINSERT\b.*\bINTO\b)/i',
            '/(\bDELETE\b.*\bFROM\b)/i',
            '/(\bUPDATE\b.*\bSET\b)/i',
            '/(\bEXEC\b|\bEXECUTE\b)/i',
            '/(\bSHOW\b.*\bTABLES\b)/i',
            '/(\bALTER\b.*\bTABLE\b)/i',
            '/(\bCREATE\b.*\bTABLE\b)/i',
            '/(\-\-\s*$)/',  // SQL comment
            '/(\/\*|\*\/)/',  // SQL comment
            '/(\bOR\b.*=.*)/i',  // OR injection
        ];

        foreach ($sqlPatterns as $pattern) {
            if (preg_match($pattern, $value)) {
                \Log::warning('SQL Injection attempt detected', [
                    'parameter' => $key,
                    'value' => substr($value, 0, 50),
                    'ip' => request()->ip(),
                    'timestamp' => now()
                ]);
                
                abort(400, 'Invalid input detected');
            }
        }
    }
}
