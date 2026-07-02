<?php

namespace App\Events;

use App\Models\Cube;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcastNow;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class CubeUpdated implements ShouldBroadcastNow
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public Cube $cube;

    public function __construct(Cube $cube)
    {
        $this->cube = $cube;
    }

    public function broadcastOn(): array
    {
        // Broadcasting on a public channel named 'cube-updates'
        return [
            new Channel('cube-updates'),
        ];
    }
}