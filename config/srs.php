<?php 

/**
 * 🔥 ENGINEER STANDARD: SRS Configuration
 * 
 * SRS (Simple Realtime Server) configuration for massive, low-latency
 * distribution to passive audiences via HLS/RTMP.
 */
return [
    'api_url' => env('SRS_API_URL', 'http://srs:1985'),
    'rtmp_url' => env('SRS_RTMP_URL', 'rtmp://localhost:1935'),
    'hls_url' => env('SRS_HLS_URL', 'http://localhost:8081'),
    
    // Security token for RTMP authentication
    'security_key' => env('SRS_SECURITY_KEY', config('app.key')),
    
    // JWT token TTL in seconds (default: 1 hour)
    'token_ttl' => env('SRS_TOKEN_TTL', 3600),
    
    // Failover SRS instances for high availability
    'failover_instances' => array_filter(explode(',', env('SRS_FAILOVER_INSTANCES', ''))),
];