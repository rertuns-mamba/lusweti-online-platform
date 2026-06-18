<?php

namespace Database\Seeders;

use App\Models\Article;
use App\Models\Category;
use App\Models\Page;
use App\Models\Video;
use Database\Seeders\Concerns\UsesPublicStorageMedia;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Throwable;

class VideoGridSeeder extends Seeder
{
    use UsesPublicStorageMedia;

    public function run(): void
    {
        $page = Page::updateOrCreate(
            ['slug' => 'videos'],
            [
                'title' => 'Video Portal',
                'bg_color' => '#2563eb',
                'text_color' => '#ffffff',
                'show_in_nav' => true,
                'nav_order' => 2,
            ]
        );

        $category = Category::updateOrCreate(
            ['slug' => 'videos'],
            [
                'name' => 'Videos',
                'title' => 'Featured Broadcasts',
                'is_active' => true,
            ]
        );

        $page->sections()->updateOrCreate(
            ['component' => 'sections.videos'],
            [
                'title' => 'Featured Broadcasts',
                'category_id' => $category->id,
                'layout_type' => 'sections.videos',
                'model_type' => Article::class,
                'limit' => 4,
                'sort_order' => 1,
                'is_active' => true,
                'is_visible' => true,
                'settings' => [
                    'category_id' => $category->id,
                    'limit' => 4,
                    'subtitle' => 'Watch the latest field reports and highlights',
                ],
            ]
        );

        foreach ($this->youtubeStories() as $index => $youtubeStory) {
            $videoUrl = $this->youtubeWatchUrl($youtubeStory['id']);

            Video::updateOrCreate(
                ['youtube_id' => $youtubeStory['id']],
                [
                    'category_id' => $category->id,
                    'title' => $youtubeStory['title'],
                    'slug' => Str::slug("youtube {$youtubeStory['title']}"),
                    'is_youtube' => true,
                    'youtube_id' => $youtubeStory['id'],
                    'video_url' => $videoUrl,
                    'is_active' => true,
                    'is_visible' => true,
                    'published_at' => now()->subDays($index),
                ]
            );
        }

        $images = $this->publicStorageImages();

        foreach ($this->publicStorageVideos() as $index => $videoPath) {
            $video = Video::updateOrCreate(
                ['slug' => "local-video-{$index}"],
                [
                    'category_id' => $category->id,
                    'title' => 'Local Storage Video '.($index + 1),
                    'is_youtube' => false,
                    'youtube_id' => null,
                    'video_url' => $this->publicStorageUrl($videoPath),
                    'is_active' => true,
                    'is_visible' => true,
                    'published_at' => now()->subHours($index + 1),
                ]
            );

            try {
                if (! $video->hasMedia('local_video')) {
                    $video
                        ->addMedia($videoPath)
                        ->preservingOriginal()
                        ->toMediaCollection('local_video');
                }

                $thumbnailPath = $images->get($index % max($images->count(), 1));

                if ($thumbnailPath && ! $video->hasMedia('custom_thumbnail')) {
                    $video
                        ->addMedia($thumbnailPath)
                        ->preservingOriginal()
                        ->toMediaCollection('custom_thumbnail');
                }
            } catch (Throwable) {
                // Keep the public URL fallback even if media conversions are unavailable.
            }
        }

        $this->command->info('Video Grid Architecture Seeded Successfully!');
    }
}
