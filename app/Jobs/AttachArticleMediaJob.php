<?php

namespace App\Jobs;

use App\Models\Article;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;

class AttachArticleMediaJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * The number of seconds the job can run before timing out.
     */
    public $timeout = 120;

    public function __construct(
        public Article $article,
        public string $imageUrl,
        public ?string $videoUrl = null,
        public string $mediaCollection = 'featured_image'
    ) {}

    public function handle(): void
    {
        try {
            // Attach Primary Image
            $this->article->addMediaFromUrl($this->imageUrl)
                ->toMediaCollection($this->mediaCollection);

            // Attach Video if provided
            if ($this->videoUrl) {
                $this->article->addMediaFromUrl($this->videoUrl)
                    ->toMediaCollection('videos');
            }
        } catch (\Throwable $e) {
            Log::warning("Failed to attach media for Article ID {$this->article->id}: {$e->getMessage()}");
            $this->fail($e);
        }
    }
}