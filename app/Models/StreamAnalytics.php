<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * 🔥 ENGINEER STANDARD: Stream Analytics Model
 * 
 * Tracks viewer counts and participant metrics for streams.
 * Records data from both LiveKit and SRS platforms.
 */
class StreamAnalytics extends Model
{
    protected $fillable = [
        'stream_id',
        'viewer_count',
        'peak_viewers',
        'livekit_participants',
        'srs_clients',
        'recorded_at',
    ];

    protected $casts = [
        'recorded_at' => 'datetime',
    ];

    public function stream(): BelongsTo
    {
        return $this->belongsTo(Stream::class);
    }

    /**
     * Record analytics data for a stream.
     */
    public static function record(array $data): self
    {
        return static::create($data);
    }

    /**
     * Get peak viewers for a stream.
     */
    public static function getPeakViewers(int $streamId): int
    {
        return static::where('stream_id', $streamId)
            ->max('peak_viewers') ?? 0;
    }

    /**
     * Get average viewers for a stream.
     */
    public static function getAverageViewers(int $streamId): float
    {
        return static::where('stream_id', $streamId)
            ->avg('viewer_count') ?? 0;
    }
}
