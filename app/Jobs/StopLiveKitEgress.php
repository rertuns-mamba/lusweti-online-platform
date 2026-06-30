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
 * 🔥 ENGINEER STANDARD: Stop LiveKit Egress Job
 * 
 * Asynchronously stops LiveKit Egress session.
 * Includes retry logic for failed attempts.
 */
class StopLiveKitEgress implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public int $tries = 3;
    public int $timeout = 60;
    public int $backoff = [5, 10, 20];

    public function __construct(
        protected string $streamUuid,
        protected string $egressId
    ) {}

    public function handle(EgressService $egressService): void
    {
        Log::info('Stopping LiveKit Egress job', [
            'stream_uuid' => $this->streamUuid,
            'egress_id' => $this->egressId,
            'attempt' => $this->attempts(),
        ]);

        $stopped = $egressService->stopEgress($this->egressId);

        if ($stopped) {
            $stream = Stream::where('uuid', $this->streamUuid)->first();
            if ($stream) {
                $stream->update(['egress_id' => null, 'is_live' => false]);
            }

            Log::info('LiveKit Egress stopped successfully', [
                'stream_uuid' => $this->streamUuid,
                'egress_id' => $this->egressId,
            ]);
        } else {
            Log::warning('Failed to stop LiveKit Egress', [
                'stream_uuid' => $this->streamUuid,
                'egress_id' => $this->egressId,
                'attempt' => $this->attempts(),
            ]);

            if ($this->attempts() >= $this->tries) {
                Log::error('StopLiveKitEgress failed after all retries', [
                    'stream_uuid' => $this->streamUuid,
                    'egress_id' => $this->egressId,
                ]);
            }

            throw new \Exception('Failed to stop LiveKit Egress');
        }
    }

    public function failed(\Throwable $exception): void
    {
        Log::error('StopLiveKitEgress job failed', [
            'stream_uuid' => $this->streamUuid,
            'egress_id' => $this->egressId,
            'error' => $exception->getMessage(),
        ]);
    }
}
