<?php

namespace App\Services;

use App\Broadcast\SRS\ApiService;
use App\Models\Stream;
use App\Models\StreamAnalytics;
use Illuminate\Support\Facades\Log;

/**
 * 🔥 ENGINEER STANDARD: Analytics Service
 * 
 * Tracks viewer counts and participant metrics from both LiveKit and SRS.
 * Records analytics data for stream performance monitoring.
 */
class AnalyticsService
{
    public function __construct(
        protected ApiService $srsApi
    ) {}

    /**
     * Record analytics for a stream.
     * 
     * @param Stream $stream The stream to record analytics for
     * @param int $livekitParticipants Number of LiveKit participants
     * @return StreamAnalytics The recorded analytics entry
     */
    public function recordAnalytics(Stream $stream, int $livekitParticipants = 0): StreamAnalytics
    {
        // Get SRS client count
        $srsStreams = $this->srsApi->getActiveStreams();
        $srsStream = collect($srsStreams)->firstWhere('name', $stream->uuid);
        $srsClients = $srsStream['clients'] ?? 0;

        // Calculate total viewers
        $viewerCount = $livekitParticipants + $srsClients;

        // Get peak viewers for this stream
        $peakViewers = StreamAnalytics::getPeakViewers($stream->id);
        $newPeak = max($peakViewers, $viewerCount);

        $analytics = StreamAnalytics::record([
            'stream_id' => $stream->id,
            'viewer_count' => $viewerCount,
            'peak_viewers' => $newPeak,
            'livekit_participants' => $livekitParticipants,
            'srs_clients' => $srsClients,
            'recorded_at' => now(),
        ]);

        Log::info('Analytics recorded', [
            'stream_uuid' => $stream->uuid,
            'viewer_count' => $viewerCount,
            'peak_viewers' => $newPeak,
            'livekit_participants' => $livekitParticipants,
            'srs_clients' => $srsClients,
        ]);

        return $analytics;
    }

    /**
     * Get current viewer count for a stream.
     */
    public function getCurrentViewers(Stream $stream): int
    {
        $srsStreams = $this->srsApi->getActiveStreams();
        $srsStream = collect($srsStreams)->firstWhere('name', $stream->uuid);
        $srsClients = $srsStream['clients'] ?? 0;

        // Note: LiveKit participant count would need to be fetched from LiveKit API
        // For now, return SRS clients only
        return $srsClients;
    }

    /**
     * Get analytics summary for a stream.
     */
    public function getAnalyticsSummary(Stream $stream): array
    {
        return [
            'stream_uuid' => $stream->uuid,
            'peak_viewers' => StreamAnalytics::getPeakViewers($stream->id),
            'average_viewers' => StreamAnalytics::getAverageViewers($stream->id),
            'current_viewers' => $this->getCurrentViewers($stream),
            'total_recordings' => StreamAnalytics::where('stream_id', $stream->id)->count(),
        ];
    }
}
