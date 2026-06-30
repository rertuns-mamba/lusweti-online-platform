<?php

namespace App\Broadcast\SRS;

/**
 * 🔥 ENGINEER STANDARD: RTMP Service
 * 
 * Generates RTMP URLs for SRS ingestion with security tokens.
 */
class RtmpService
{
    protected string $rtmpHost;
    protected string $securityKey;

    public function __construct()
    {
        $this->rtmpHost = config('srs.rtmp_url', 'rtmp://localhost:1935');
        $this->securityKey = config('srs.security_key', config('app.key'));
    }

    /**
     * Generate the RTMP URL that LiveKit Egress will push to.
     */
    public function getEgressPushUrl(string $streamKey, string $securityToken): string
    {
        $app = 'live';
        return sprintf('%s/%s/%s?token=%s', $this->rtmpHost, $app, $streamKey, $securityToken);
    }

    /**
     * Generate a security token for RTMP authentication using JWT.
     */
    public function generateSecurityToken(string $streamKey): string
    {
        $tokenService = app(\App\Broadcast\SRS\TokenService::class);
        return $tokenService->generateToken($streamKey);
    }
}