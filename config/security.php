<?php

/**
 * SECURITY CONFIGURATION & BEST PRACTICES
 * File ini berisi panduan implementasi security best practices di aplikasi Laravel
 */

return [
    
    /*
    |--------------------------------------------------------------------------
    | AUTHENTICATION SECURITY
    |--------------------------------------------------------------------------
    |
    | Konfigurasi untuk authentication security
    |
    */
    
    'authentication' => [
        // Password minimum requirements
        'password_min_length' => 12,
        'password_require_uppercase' => true,
        'password_require_numbers' => true,
        'password_require_special_chars' => true,
        
        // Login attempt limits untuk prevent brute force
        'login_max_attempts' => 5,
        'login_decay_minutes' => 15,
        
        // Session timeout
        'session_timeout_minutes' => 30,
        
        // Remember me duration
        'remember_token_duration_days' => 30,
    ],

    /*
    |--------------------------------------------------------------------------
    | DATABASE SECURITY
    |--------------------------------------------------------------------------
    |
    | Konfigurasi untuk database security
    |
    */
    
    'database' => [
        // Selalu gunakan parameterized queries (Eloquent by default)
        // JANGAN gunakan raw queries dengan string concatenation
        
        // Contoh AMAN:
        // User::where('email', $email)->first();
        // DB::select('SELECT * FROM users WHERE email = ?', [$email]);
        
        // Contoh BERBAHAYA (JANGAN DIGUNAKAN):
        // DB::select("SELECT * FROM users WHERE email = '$email'");
        // DB::select("SELECT * FROM users WHERE email = " . $email);
        
        // Encrypt sensitive fields
        'encrypted_fields' => [
            'users' => ['email', 'phone'],
            'orders' => ['address', 'phone_number'],
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | CORS SECURITY
    |--------------------------------------------------------------------------
    |
    | Konfigurasi untuk CORS (Cross-Origin Resource Sharing)
    |
    */
    
    'cors' => [
        'allowed_origins' => [
            'http://localhost:3000',
            'http://localhost:8000',
            // env('APP_URL'),
        ],
        'allowed_methods' => ['GET', 'POST', 'PUT', 'DELETE', 'OPTIONS', 'PATCH'],
        'allowed_headers' => ['Content-Type', 'Authorization', 'X-Requested-With'],
    ],

    /*
    |--------------------------------------------------------------------------
    | FILE UPLOAD SECURITY
    |--------------------------------------------------------------------------
    |
    | Konfigurasi untuk file upload security
    |
    */
    
    'file_upload' => [
        // Allowed MIME types
        'allowed_mimes' => ['jpg', 'jpeg', 'png', 'gif', 'pdf', 'doc', 'docx'],
        
        // Maksimal file size (dalam bytes)
        'max_file_size' => 5 * 1024 * 1024, // 5MB
        
        // Scan uploaded files dengan antivirus
        'scan_with_antivirus' => false,
        
        // Store files di private storage (bukan public)
        'store_private' => true,
    ],

    /*
    |--------------------------------------------------------------------------
    | API SECURITY
    |--------------------------------------------------------------------------
    |
    | Konfigurasi untuk API security
    |
    */
    
    'api' => [
        // API rate limiting
        'rate_limit_requests' => 100,
        'rate_limit_minutes' => 1,
        
        // API token expiration
        'token_expiration_hours' => 24,
        
        // Require HTTPS untuk production
        'require_https' => env('APP_ENV') === 'production',
    ],

    /*
    |--------------------------------------------------------------------------
    | LOGGING & MONITORING
    |--------------------------------------------------------------------------
    |
    | Konfigurasi untuk security logging & monitoring
    |
    */
    
    'logging' => [
        // Log semua authentication attempts
        'log_auth_attempts' => true,
        
        // Log sensitive operations
        'log_sensitive_operations' => true,
        
        // Log errors & exceptions
        'log_errors' => true,
        
        // Log file path
        'security_log_path' => storage_path('logs/security.log'),
    ],

    /*
    |--------------------------------------------------------------------------
    | ENCRYPTION
    |--------------------------------------------------------------------------
    |
    | Konfigurasi untuk encryption
    |
    */
    
    'encryption' => [
        // Gunakan AES-256-CBC atau AES-256-GCM
        'cipher' => 'AES-256-CBC',
        
        // App key harus di-set di .env file
        // Generate dengan: php artisan key:generate
    ],

    /*
    |--------------------------------------------------------------------------
    | SECURITY HEADERS
    |--------------------------------------------------------------------------
    |
    | HTTP security headers untuk protect dari berbagai attacks
    |
    */
    
    'headers' => [
        'X-Frame-Options' => 'DENY',  // Prevent clickjacking
        'X-Content-Type-Options' => 'nosniff',  // Prevent MIME type sniffing
        'X-XSS-Protection' => '1; mode=block',  // Protect dari XSS
        'Strict-Transport-Security' => 'max-age=31536000; includeSubDomains; preload',  // Force HTTPS
        'Content-Security-Policy' => "default-src 'self'",  // CSP untuk prevent XSS & injection
        'Referrer-Policy' => 'strict-origin-when-cross-origin',  // Control referrer info
        'Permissions-Policy' => 'geolocation=(), microphone=(), camera=()',  // Disable unnecessary features
    ],

    /*
    |--------------------------------------------------------------------------
    | DEVELOPER NOTES
    |--------------------------------------------------------------------------
    |
    | Catatan penting untuk developer:
    |
    | 1. Selalu validate & sanitize user input
    | 2. Gunakan parameterized queries untuk semua database operations
    | 3. Hash passwords menggunakan bcrypt atau argon2
    | 4. Encrypt sensitive data sebelum menyimpan di database
    | 5. Jangan expose error details ke user (di production)
    | 6. Implementasikan rate limiting untuk prevent brute force
    | 7. Gunakan HTTPS di production
    | 8. Regular security updates untuk dependencies
    | 9. Implementasikan proper logging & monitoring
    | 10. Conduct regular security audits & penetration testing
    |
    */

];
