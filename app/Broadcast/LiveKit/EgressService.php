<?php

namespace App\Broadcast\LiveKit;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use App\Broadcast\SRS\RtmpService;

/**
 * 🔥 ENGINEER STANDARD: LiveKit Egress Service
 * 
 * Handles pushing LiveKit room streams to SRS via RTMP for massive distribution.
 * This bridges LiveKit's interactive capabilities with SRS's scalable HLS delivery.
 */
class EgressService
{
    protected string $livekitUrl;
    protected string $apiKey;
    protected string $apiSecret;
    protected RtmpService $rtmp;

    public function __construct(RtmpService $rtmp)
    {
        $this->livekitUrl = config('services.livekit.url');
        $this->apiKey = config('services.livekit.key');
        $this->apiSecret = config('services.livekit.secret');
        $this->rtmp = $rtmp;
    }

    /**
     * Start an RTMP egress from a LiveKit room to SRS.
     * 
     * @param string $roomName The LiveKit room name
     * @param string $streamKey The SRS stream key
     * @param string $securityToken The SRS security token
     * @return array|null Returns egress info on success, null on failure
     */
    public function startRtmpEgress(string $roomName, string $streamKey, string $securityToken): ?array
    {
        $rtmpUrl = $this->rtmp->getEgressPushUrl($streamKey, $securityToken);
        
        $payload = [
            'room_name' => $roomName,
            'output' => [
                'type' => 'rtmp',
                'rtmp' => [
                    'url' => $rtmpUrl,
                ],
            ],
            'audio' => [
                'name' => 'audio',
                'source' => 'track_composite',
            ],
            'video' => [
                'name' => 'video',
                'source' => 'track_composite',
            ],
        ];

        try {
            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . $this->generateAdminToken(),
                'Content-Type' => 'application/json',
            ])->post("{$this->livekitUrl}/egress", $payload);

            if ($response->successful()) {
                $egressData = $response->json();
                Log::info('LiveKit Egress Started', [
                    'room' => $roomName,
                    'egress_id' => $egressData['egress_id'] ?? null,
                    'rtmp_url' => $rtmpUrl,
                ]);
                return $egressData;
            }

            Log::error('LiveKit Egress Failed', [
                'room' => $roomName,
                'response' => $response->body(),
                'status' => $response->status(),
            ]);
            return null;
        } catch (\Exception $e) {
            Log::error('LiveKit Egress Exception', [
                'room' => $roomName,
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
            ]);
            return null;
        }
    }

    /**
     * Stop an active egress by ID.
     */
    public function stopEgress(string $egressId): bool
    {
        try {
            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . $this->generateAdminToken(),
                'Content-Type' => 'application/json',
            ])->delete("{$this->livekitUrl}/egress/{$egressId}");

            if ($response->successful()) {
                Log::info('LiveKit Egress Stopped', ['egress_id' => $egressId]);
                return true;
            }

            Log::error('Failed to stop LiveKit Egress', [
                'egress_id' => $egressId,
                'response' => $response->body(),
            ]);
            return false;
        } catch (\Exception $e) {
            Log::error('Exception stopping LiveKit Egress', [
                'egress_id' => $egressId,
                'error' => $e->getMessage(),
            ]);
            return false;
        }
    }

    /**
     * Get list of active egress sessions.
     */
    public function listActiveEgress(): array
    {
        try {
            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . $this->generateAdminToken(),
            ])->get("{$this->livekitUrl}/egress/list");

            if ($response->successful()) {
                return $response->json('items') ?? [];
            }

            Log::error('Failed to list LiveKit Egress', ['response' => $response->body()]);
            return [];
        } catch (\Exception $e) {
            Log::error('Exception listing LiveKit Egress', ['error' => $e->getMessage()]);
            return [];
        }
    }

    /**
     * Generate a short-lived admin token for Egress API calls.
     */
    protected function generateAdminToken(): string
    {
        $options = (new \Agence104\LiveKit\AccessTokenOptions())
            ->setIdentity('system_admin')
            ->setTtl(300); // 5 minutes for API calls

        $grant = (new \Agence104\LiveKit\VideoGrant())
            ->setRoomRecord(true)
            ->setRoomAdmin(true);

        $token = new \Agence104\LiveKit\AccessToken(
            $this->apiKey,
            $this->apiSecret
        );

        return $token
            ->init($options)
            ->setGrant($grant)
            ->toJwt();
    }
}
