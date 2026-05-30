<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class LogSecurityEventsMiddleware
{
    /**
     * Handle an incoming request.
     * Middleware untuk logging semua security-related events
     * Berguna untuk monitoring dan forensic analysis
     */
    public function handle(Request $request, Closure $next)
    {
        // Log request details untuk audit trail
        $this->logRequest($request);

        $response = $next($request);

        // Log response details
        $this->logResponse($request, $response);

        return $response;
    }

    /**
     * Log incoming request untuk security audit
     */
    private function logRequest(Request $request)
    {
        // Skip logging untuk health check endpoints
        if ($request->is('health', 'ping', 'status')) {
            return;
        }

        $logData = [
            'type' => 'HTTP_REQUEST',
            'method' => $request->method(),
            'path' => $request->path(),
            'ip' => $request->ip(),
            'user_agent' => $request->userAgent(),
            'user_id' => auth()->id(),
            'timestamp' => now(),
            'url' => $request->url(),
        ];

        // Log sensitive operations
        if ($this->isSensitiveOperation($request)) {
            $logData['sensitive_operation'] = true;
            $logData['input_keys'] = array_keys($request->all());
            
            \Log::info('Sensitive Operation Detected', $logData);
        }

        // Log failed authentication attempts
        if ($request->is('login', 'register', '*/login', '*/register') && !auth()->check()) {
            $logData['operation'] = 'auth_attempt';
            \Log::info('Authentication Attempt', $logData);
        }
    }

    /**
     * Log response details untuk security audit
     */
    private function logResponse(Request $request, $response)
    {
        // Log error responses
        if ($response->status() >= 400) {
            $logData = [
                'type' => 'HTTP_ERROR',
                'method' => $request->method(),
                'path' => $request->path(),
                'status' => $response->status(),
                'ip' => $request->ip(),
                'user_id' => auth()->id(),
                'timestamp' => now(),
            ];

            // Log 4xx dan 5xx errors
            if ($response->status() >= 500) {
                \Log::error('Server Error', $logData);
            } elseif ($response->status() === 401 || $response->status() === 403) {
                \Log::warning('Unauthorized Access Attempt', $logData);
            } elseif ($response->status() === 400) {
                \Log::warning('Bad Request', $logData);
            }
        }
    }

    /**
     * Deteksi apakah operasi adalah sensitive operation
     */
    private function isSensitiveOperation(Request $request): bool
    {
        $sensitiveOperations = [
            'admin',
            'user/profile',
            'checkout',
            'payment',
            'order',
            'password',
            'delete',
            'update',
        ];

        foreach ($sensitiveOperations as $operation) {
            if ($request->is('*' . $operation . '*')) {
                return true;
            }
        }

        return $request->method() !== 'GET';
    }
}
