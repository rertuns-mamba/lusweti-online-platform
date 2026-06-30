<?php

namespace App\Jobs;

use App\Broadcast\LiveKit\EgressService;
use App\Models\Stream;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;

/**
 * 🔥 ENGINEER STANDARD: Start LiveKit Egress Job
 * 
 * Asynchronously starts LiveKit Egress to push stream to SRS.
 * Includes retry logic for failed attempts.
 */
class StartLiveKitEgress implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public int $tries = 3;
    public int $timeout = 120;
    public int $backoff = [5, 10, 30]; // Exponential backoff: 5s, 10s, 30s

    public function __construct(
        protected string $streamUuid,
        protected string $roomName,
        protected string $securityToken
    ) {}

    public function handle(EgressService $egressService): void
    {
        $stream = Stream::where('uuid', $this->streamUuid)->first();

        if (!$stream) {
            Log::error('Stream not found for egress start', ['stream_uuid' => $this->streamUuid]);
            return;
        }

        Log::info('Starting LiveKit Egress job', [
            'stream_uuid' => $this->streamUuid,
            'room_name' => $this->roomName,
            'attempt' => $this->attempts(),
        ]);

        $egressResult = $egressService->startRtmpEgress(
            $this->roomName,
            $this->streamUuid,
            $this->securityToken
        );

        if ($egressResult && isset($egressResult['egress_id'])) {
            $stream->update(['egress_id' => $egressResult['egress_id']]);
            
            Log::info('LiveKit Egress started successfully', [
                'stream_uuid' => $this->streamUuid,
                'egress_id' => $egressResult['egress_id'],
            ]);
        } else {
            Log::error('Failed to start LiveKit Egress', [
                'stream_uuid' => $this->streamUuid,
                'attempt' => $this->attempts(),
            ]);
            
            if ($this->attempts() >= $this->tries) {
                Log::critical('LiveKit Egress failed after all retries', [
                    'stream_uuid' => $this->streamUuid,
                    'max_attempts' => $this->tries,
                ]);
            }
            
            throw new \Exception('Failed to start LiveKit Egress');
        }
    }

    public function failed(\Throwable $exception): void
    {
        Log::error('StartLiveKitEgress job failed', [
            'stream_uuid' => $this->streamUuid,
            'error' => $exception->getMessage(),
            'attempts' => $this->attempts(),
        ]);

        // Update stream status to reflect failure
        $stream = Stream::where('uuid', $this->streamUuid)->first();
        if ($stream) {
            $stream->update(['is_live' => false]);
        }
    }
}
