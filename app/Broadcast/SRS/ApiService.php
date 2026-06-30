<?php

namespace App\Broadcast\SRS;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

/**
 * 🔥 ENGINEER STANDARD: SRS API Service with Failover
 * 
 * Handles SRS API interaction with automatic failover to backup instances.
 */
class ApiService
{
    protected string $apiUrl;
    protected array $failoverInstances;

    public function __construct()
    {
        $this->apiUrl = config('srs.api_url', 'http://srs:1985');
        $this->failoverInstances = config('srs.failover_instances', []);
    }

    /**
     * Get a list of all active streams on the SRS server.
     * Automatically fails over to backup instances if primary fails.
     */
    public function getActiveStreams(): array
    {
        $instances = array_merge([$this->apiUrl], $this->failoverInstances);

        foreach ($instances as $instance) {
            try {
                $response = Http::timeout(5)->get("{$instance}/api/v1/streams");

                if ($response->successful()) {
                    $streams = $response->json('streams') ?? [];
                    
                    if ($instance !== $this->apiUrl) {
                        Log::info('SRS API failover successful', [
                            'primary' => $this->apiUrl,
                            'failover' => $instance,
                        ]);
                    }
                    
                    return $streams;
                }
            } catch (\Exception $e) {
                Log::warning('SRS API instance failed', [
                    'instance' => $instance,
                    'error' => $e->getMessage(),
                ]);
                continue;
            }
        }

        Log::error('SRS API Error: All instances failed to fetch streams');
        return [];
    }

    /**
     * Kick an active client/stream using their SRS Client ID.
     * Automatically fails over to backup instances if primary fails.
     */
    public function kickClient(string $clientId): bool
    {
        $instances = array_merge([$this->apiUrl], $this->failoverInstances);

        foreach ($instances as $instance) {
            try {
                $response = Http::timeout(5)->delete("{$instance}/api/v1/clients/{$clientId}");

                if ($response->successful()) {
                    if ($instance !== $this->apiUrl) {
                        Log::info('SRS API kick failover successful', [
                            'primary' => $this->apiUrl,
                            'failover' => $instance,
                        ]);
                    }
                    
                    return true;
                }
            } catch (\Exception $e) {
                Log::warning('SRS API kick instance failed', [
                    'instance' => $instance,
                    'error' => $e->getMessage(),
                ]);
                continue;
            }
        }

        Log::error('SRS API Error: All instances failed to kick client');
        return false;
    }

    /**
     * Check health of all SRS instances.
     */
    public function healthCheck(): array
    {
        $instances = array_merge([$this->apiUrl], $this->failoverInstances);
        $health = [];

        foreach ($instances as $instance) {
            try {
                $response = Http::timeout(3)->get("{$instance}/api/v1/summaries");
                
                $health[$instance] = [
                    'healthy' => $response->successful(),
                    'status' => $response->successful() ? 'ok' : 'failed',
                    'response_time' => $response->successful() ? $response->handlerStats()['total_time'] ?? null : null,
                ];
            } catch (\Exception $e) {
                $health[$instance] = [
                    'healthy' => false,
                    'status' => 'error',
                    'error' => $e->getMessage(),
                ];
            }
        }

        return $health;
    }
}