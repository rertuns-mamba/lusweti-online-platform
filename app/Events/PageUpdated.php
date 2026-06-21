<?php

namespace App\Events;

use App\Models\Page;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcastNow;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class PageUpdated implements ShouldBroadcastNow
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public function __construct(public Page $page) {}

    public function broadcastOn(): array
    {
        return [
            new Channel('pages'),
            new Channel('pages.'.$this->page->id),
        ];
    }

    public function broadcastAs(): string
    {
        return 'page.mutated';
    }

    public function broadcastConnection(): string
    {
        return 'reverb';
    }

    public function broadcastWith(): array
    {
        return [
            'id' => $this->page->id,
            'title' => $this->page->title,
            'slug' => $this->page->slug,
            'is_visible_in_nav' => $this->page->is_visible_in_nav,
            'status' => $this->page->status,
            'action' => $this->page->wasRecentlyCreated ? 'created' : 'updated',
        ];
    }
}
