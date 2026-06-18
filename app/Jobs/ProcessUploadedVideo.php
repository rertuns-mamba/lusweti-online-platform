<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use ProtoneMedia\LaravelFFMpeg\Support\FFMpeg;
use FFMpeg\Format\Video\X264;

class ProcessUploadedVideo implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public function __construct(public string $filePath) {}

    public function handle(): void
    {
        // 1. Export an optimized, compressed H.264 version of the video
        FFMpeg::fromDisk('local')
            ->open($this->filePath)
            ->export()
            ->toDisk('public')
            ->inFormat(new X264('aac'))
            ->save('videos/optimized_' . basename($this->filePath));

        // 2. Extract a snapshot thumbnail frame precisely 3 seconds in
        FFMpeg::fromDisk('local')
            ->open($this->filePath)
            ->getFrameFromSeconds(3)
            ->export()
            ->toDisk('public')
            ->save('thumbnails/poster_' . pathinfo($this->filePath, PATHINFO_FILENAME) . '.jpg');
    }
}
