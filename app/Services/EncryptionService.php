<?php

namespace App\Services;

use Illuminate\Support\Facades\Crypt;

class EncryptionService
{
    /**
     * Encrypt sensitive data seperti personal information, payment details, etc
     * 
     * Gunakan service ini untuk mengenkripsi data sensitif sebelum menyimpan ke database
     */
    public static function encryptSensitiveData($data)
    {
        try {
            return Crypt::encryptString($data);
        } catch (\Exception $e) {
            \Log::error('Encryption error: ' . $e->getMessage());
            throw $e;
        }
    }

    /**
     * Decrypt sensitive data
     */
    public static function decryptSensitiveData($encryptedData)
    {
        try {
            return Crypt::decryptString($encryptedData);
        } catch (\Exception $e) {
            \Log::error('Decryption error: ' . $e->getMessage());
            throw $e;
        }
    }

    /**
     * Hash password menggunakan bcrypt (Argon2 untuk future-proofing)
     * Digunakan saat user create account atau change password
     */
    public static function hashPassword($password)
    {
        // Laravel menggunakan bcrypt by default
        // Config di config/hashing.php bisa diubah ke 'argon2id'
        return \Hash::make($password);
    }

    /**
     * Verify password
     */
    public static function verifyPassword($password, $hash)
    {
        return \Hash::check($password, $hash);
    }

    /**
     * Generate secure token untuk password reset, email verification, etc
     */
    public static function generateSecureToken($length = 32)
    {
        return bin2hex(random_bytes($length / 2));
    }

    /**
     * Generate API token
     */
    public static function generateApiToken()
    {
        return bin2hex(random_bytes(32));
    }
}
