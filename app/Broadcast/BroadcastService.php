<?php

namespace App\Broadcast;

use App\Broadcast\LiveKit\EgressService;
use App\Broadcast\SRS\SrsService;
use App\Jobs\StartLiveKitEgress;
use App\Jobs\StopLiveKitEgress;
use App\Models\Stream;
use App\Services\LiveKitService;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

/**
 * 🔥 ENGINEER STANDARD: Unified Broadcast Service
 * 
 * Orchestrates dual-streaming architecture:
 * - LiveKit: High-fidelity, sub-second interactive collaboration
 * - SRS: Massive, low-latency distribution to passive audiences
 * 
 * This service provides a unified interface without changing logical flow.
 * Uses queue jobs for async egress management with retry logic.
 */
class BroadcastService
{
    public function __construct(
        protected LiveKitService $livekit,
        protected EgressService $egress,
        protected SrsService $srs
    ) {}

    /**
     * Start a broadcast with both LiveKit and SRS.
     * 
     * @param Stream $stream The stream model
     * @param \App\Models\User $user The host user
     * @param bool $async Use queue job for async egress start
     * @return array Returns connection details for both platforms
     */
    public function startBroadcast(Stream $stream, $user, bool $async = true): array
    {
        Log::info('Starting broadcast', ['stream_uuid' => $stream->uuid, 'async' => $async]);

        // Generate or retrieve LiveKit room name
        $roomName = $stream->livekit_room ?? $this->generateRoomName($stream);

        // Update stream with room name
        if (!$stream->livekit_room) {
            $stream->update(['livekit_room' => $roomName]);
        }

        // Generate LiveKit token for host
        $livekitCredentials = $this->livekit->generateToken($user, $roomName, true);

        // Generate SRS security token
        $srsToken = $this->srs->rtmp->generateSecurityToken($stream->uuid);

        // Start LiveKit Egress to SRS (async or sync)
        if ($async) {
            dispatch(new StartLiveKitEgress($stream->uuid, $roomName, $srsToken));
            $egressId = null; // Will be set by job
        } else {
            $egressResult = $this->egress->startRtmpEgress(
                $roomName,
                $stream->uuid,
                $srsToken
            );

            if ($egressResult && isset($egressResult['egress_id'])) {
                $stream->update(['egress_id' => $egressResult['egress_id']]);
                $egressId = $egressResult['egress_id'];
            } else {
                $egressId = null;
            }
        }

        // Get SRS connection details
        $srsDetails = $this->srs->getChannelConnectionDetails($stream->uuid, $srsToken);

        Log::info('Broadcast initiated', [
            'stream_uuid' => $stream->uuid,
            'room_name' => $roomName,
            'async' => $async,
            'egress_id' => $egressId ?? 'pending',
        ]);

        return [
            'livekit' => [
                'room' => $roomName,
                'token' => $livekitCredentials['token'],
                'url' => $livekitCredentials['url'],
            ],
            'srs' => [
                'ingest_url' => $srsDetails['ingest_url'],
                'playback_url' => $srsDetails['playback_url'],
            ],
            'stream' => [
                'uuid' => $stream->uuid,
                'title' => $stream->title,
                'async' => $async,
            ],
        ];
    }

    /**
     * Stop a broadcast and cleanup resources.
     * 
     * @param Stream $stream The stream model
     * @param bool $async Use queue job for async egress stop
     * @return bool Returns true if successful
     */
    public function stopBroadcast(Stream $stream, bool $async = true): bool
    {
        Log::info('Stopping broadcast', ['stream_uuid' => $stream->uuid, 'async' => $async]);

        $success = true;

        // Stop LiveKit Egress if active
        if ($stream->egress_id) {
            if ($async) {
                dispatch(new StopLiveKitEgress($stream->uuid, $stream->egress_id));
                $stream->update(['egress_id' => null, 'is_live' => false]);
            } else {
                $egressStopped = $this->egress->stopEgress($stream->egress_id);
                if (!$egressStopped) {
                    Log::warning('Failed to stop egress', ['egress_id' => $stream->egress_id]);
                    $success = false;
                }
                $stream->update(['egress_id' => null, 'is_live' => false]);
            }
        } else {
            // Just update stream status if no egress
            $stream->update(['is_live' => false]);
        }

        Log::info('Broadcast stopped', ['stream_uuid' => $stream->uuid, 'success' => $success]);

        return $success;
    }

    /**
     * Get viewer credentials for passive audience (SRS HLS).
     */
    public function getViewerCredentials(Stream $stream): array
    {
        return [
            'type' => 'hls',
            'playback_url' => $this->srs->hls->getPlaybackUrl($stream->uuid),
            'stream_uuid' => $stream->uuid,
            'is_live' => $stream->is_live,
        ];
    }

    /**
     * Get participant credentials for interactive session (LiveKit).
     */
    public function getParticipantCredentials(Stream $stream, $user, bool $canPublish = false): array
    {
        $roomName = $stream->livekit_room ?? $this->generateRoomName($stream);

        $credentials = $this->livekit->generateToken($user, $roomName, $canPublish);

        return [
            'type' => 'livekit',
            'room' => $roomName,
            'token' => $credentials['token'],
            'url' => $credentials['url'],
            'can_publish' => $canPublish,
        ];
    }

    /**
     * Get broadcast status for a stream.
     */
    public function getBroadcastStatus(Stream $stream): array
    {
        $status = [
            'stream_uuid' => $stream->uuid,
            'is_live' => $stream->is_live,
            'livekit_room' => $stream->livekit_room,
            'has_egress' => !empty($stream->egress_id),
        ];

        // Check SRS active streams
        $srsStreams = $this->srs->api->getActiveStreams();
        $srsActive = collect($srsStreams)->contains('name', $stream->uuid);
        $status['srs_active'] = $srsActive;

        // Check LiveKit Egress status
        if ($stream->egress_id) {
            $activeEgress = collect($this->egress->listActiveEgress())
                ->firstWhere('egress_id', $stream->egress_id);
            $status['egress_active'] = $activeEgress !== null;
        } else {
            $status['egress_active'] = false;
        }

        return $status;
    }

    /**
     * Generate a unique room name for LiveKit.
     */
    protected function generateRoomName(Stream $stream): string
    {
        return 'stream_' . Str::slug($stream->title) . '_' . $stream->uuid;
    }
}
