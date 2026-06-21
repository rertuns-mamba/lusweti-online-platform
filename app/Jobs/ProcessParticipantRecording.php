<?php

namespace App\Jobs;

use App\Events\RecordingFinalized;
use App\Services\RecordingService;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;
use Throwable;

class ProcessParticipantRecording implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $timeout = 3600; // Allow 1 hour for large files

    public function __construct(
        public string $sessionId,
        public string $participantId
    ) {}

    public function handle(RecordingService $recordingService): void
    {
        try {
            $downloadUrl = $recordingService->finalizeParticipant(
                $this->sessionId,
                $this->participantId
            );

            // Notify frontend via Pusher/Reverb
            broadcast(new RecordingFinalized($this->sessionId, $downloadUrl));

        } catch (Throwable $e) {
            Log::error('FFmpeg Processing Failed: '.$e->getMessage());
            // Optionally broadcast a failure event here
        }
    }
}
