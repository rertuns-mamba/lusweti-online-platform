<?php

namespace App\Events;

use App\Models\Article;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcastNow;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class ArticlePublished implements ShouldBroadcastNow
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * Inject the updated article context.
     */
    public function __construct(public Article $article) {}

    /**
     * Broadcast to a public channel accessible by global visitors.
     */
    public function broadcastOn(): array
    {
        return [
            new Channel('magazine-stream'),
            new Channel('articles.'.$this->article->id),
        ];
    }

    /**
     * Broadcast naming standard alignment.
     */
    public function broadcastAs(): string
    {
        return 'article.mutated';
    }

    /**
     * Specify the broadcast connection for Reverb.
     */
    public function broadcastConnection(): string
    {
        return 'reverb';
    }

    /**
     * Include article data in broadcast payload.
     */
    public function broadcastWith(): array
    {
        return [
            'id' => $this->article->id,
            'title' => $this->article->title,
            'slug' => $this->article->slug,
            'is_visible' => $this->article->is_visible,
            'published_at' => $this->article->published_at?->toISOString(),
            'featured_image_url' => $this->article->featured_image_url,
            'category_id' => $this->article->category_id,
            'action' => $this->article->wasRecentlyCreated ? 'created' : 'updated',
        ];
    }
}
