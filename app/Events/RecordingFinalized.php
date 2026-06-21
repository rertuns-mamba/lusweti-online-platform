<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcastNow;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class RecordingFinalized implements ShouldBroadcastNow
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public string $sessionId;

    public string $downloadUrl;

    public function __construct(string $sessionId, string $downloadUrl)
    {
        $this->sessionId = $sessionId;
        $this->downloadUrl = $downloadUrl;
    }

    public function broadcastOn(): array
    {
        // Broadcasting to a specific session channel
        return [
            new Channel('recording.'.$this->sessionId),
        ];
    }

    public function broadcastAs(): string
    {
        return 'recording.ready';
    }
}
