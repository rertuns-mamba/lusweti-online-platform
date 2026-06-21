<?php

namespace App\Events;

use App\Models\PageSection;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcastNow;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class PageSectionUpdated implements ShouldBroadcastNow
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public function __construct(public PageSection $section) {}

    public function broadcastOn(): array
    {
        return [
            new Channel('page-sections'),
            new Channel('page-sections.'.$this->section->id),
            new Channel('pages.'.$this->section->page_id),
        ];
    }

    public function broadcastAs(): string
    {
        return 'page-section.mutated';
    }

    public function broadcastConnection(): string
    {
        return 'reverb';
    }

    public function broadcastWith(): array
    {
        return [
            'id' => $this->section->id,
            'title' => $this->section->title,
            'component' => $this->section->component,
            'page_id' => $this->section->page_id,
            'category_id' => $this->section->category_id,
            'is_active' => $this->section->is_active,
            'is_visible' => $this->section->is_visible,
            'action' => $this->section->wasRecentlyCreated ? 'created' : 'updated',
        ];
    }
}
