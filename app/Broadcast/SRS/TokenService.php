<?php

namespace App\Broadcast\SRS;

use Firebase\JWT\JWT;
use Firebase\JWT\Key;
use Illuminate\Support\Facades\Log;

/**
 * 🔥 ENGINEER STANDARD: SRS Token Service
 * 
 * Handles JWT-based token generation and validation for SRS RTMP authentication.
 * Provides secure, time-limited tokens for stream authorization.
 */
class TokenService
{
    protected string $secretKey;
    protected int $tokenTtl;

    public function __construct()
    {
        $this->secretKey = config('srs.security_key', config('app.key'));
        $this->tokenTtl = config('srs.token_ttl', 3600); // 1 hour default
    }

    /**
     * Generate a JWT token for SRS RTMP authentication.
     * 
     * @param string $streamKey The stream UUID
     * @param int|null $ttl Optional custom TTL in seconds
     * @return string The JWT token
     */
    public function generateToken(string $streamKey, ?int $ttl = null): string
    {
        $payload = [
            'iss' => config('app.name'),
            'sub' => $streamKey,
            'iat' => time(),
            'exp' => time() + ($ttl ?? $this->tokenTtl),
            'nbf' => time(),
            'stream_key' => $streamKey,
        ];

        return JWT::encode($payload, $this->secretKey, 'HS256');
    }

    /**
     * Validate a JWT token for SRS RTMP authentication.
     * 
     * @param string $token The JWT token to validate
     * @return array|false Returns payload if valid, false if invalid
     */
    public function validateToken(string $token): array|false
    {
        try {
            $decoded = JWT::decode($token, new Key($this->secretKey, 'HS256'));
            return (array) $decoded;
        } catch (\Exception $e) {
            Log::warning('SRS Token validation failed', [
                'error' => $e->getMessage(),
                'token' => substr($token, 0, 20) . '...',
            ]);
            return false;
        }
    }

    /**
     * Extract stream key from a JWT token without full validation.
     * Useful for quick lookups before full validation.
     * 
     * @param string $token The JWT token
     * @return string|null The stream key or null if invalid
     */
    public function extractStreamKey(string $token): ?string
    {
        try {
            $decoded = JWT::decode($token, new Key($this->secretKey, 'HS256'));
            return $decoded->stream_key ?? null;
        } catch (\Exception $e) {
            return null;
        }
    }

    /**
     * Check if a token is expired.
     * 
     * @param string $token The JWT token
     * @return bool True if expired, false otherwise
     */
    public function isTokenExpired(string $token): bool
    {
        $payload = $this->validateToken($token);
        
        if (!$payload) {
            return true;
        }

        return isset($payload['exp']) && $payload['exp'] < time();
    }
}
