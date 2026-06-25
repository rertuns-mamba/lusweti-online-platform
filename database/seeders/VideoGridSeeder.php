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

    public $withinTransaction = false;

    public function run(): void
    {
        $page = Page::updateOrCreate(
            ['slug' => 'videos'],
            [
                'title' => 'Video',
                'bg_color' => '#2563eb',
                'text_color' => '#ffffff',
                'show_in_nav' => true,
                'nav_order' => 5,
            ]
        );

        $category = Category::updateOrCreate(
            ['slug' => 'videos'],
            [
                'name' => 'Videos',
                'title' => 'Videos',
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

        // Add editorial grid block for video-related articles
        $newsCategory = Category::updateOrCreate(
            ['slug' => 'video-news'],
            [
                'name' => 'Video News',
                'title' => 'Video News',
                'is_active' => true,
            ]
        );

        $page->sections()->updateOrCreate(
            ['component' => 'sections.editorial-grid-block'],
            [
                'title' => 'Video News',
                'component' => 'sections.editorial-grid-block',
                'model_type' => Article::class,
                'category_id' => $newsCategory->id,
                'limit' => 10,
                'sort_order' => 2,
                'is_active' => true,
                'is_visible' => true,
            ]
        );

        // Create sample articles with different content types
        $images = $this->publicStorageImages();
        $externalStories = $this->externalStories();

        // Article with local image
        $localImageArticle = Article::updateOrCreate(
            ['slug' => 'video-news-local-image'],
            [
                'category_id' => $newsCategory->id,
                'title' => 'Local Image Article',
                'slug' => 'video-news-local-image',
                'summary' => 'Article with local image from storage',
                'content' => 'This article features a local image from public storage.',
                'is_visible' => true,
                'published_at' => now()->subDays(1),
            ]
        );

        // Attach local image to article
        if ($images->isNotEmpty() && ! $localImageArticle->hasMedia('featured_image')) {
            try {
                $localImageArticle
                    ->addMedia($images->first())
                    ->preservingOriginal()
                    ->toMediaCollection('featured_image');
            } catch (Throwable) {
                // Keep article even if media attachment fails
            }
        }

        // Article with external URL
        Article::updateOrCreate(
            ['slug' => 'video-news-external-url'],
            [
                'category_id' => $newsCategory->id,
                'title' => $externalStories[0]['title'],
                'slug' => 'video-news-external-url',
                'summary' => 'External article from news source',
                'external_url' => $externalStories[0]['url'],
                'featured_image_thumb_url' => $externalStories[0]['image'],
                'is_visible' => true,
                'published_at' => now()->subDays(2),
            ]
        );

        // Article with YouTube video
        Article::updateOrCreate(
            ['slug' => 'video-news-youtube'],
            [
                'category_id' => $newsCategory->id,
                'title' => 'YouTube Video Article',
                'slug' => 'video-news-youtube',
                'summary' => 'Article embedded with YouTube video',
                'content' => 'This article contains an embedded YouTube video.',
                'is_youtube' => true,
                'video_url' => $this->youtubeWatchUrl('jNQXAC9IVRw'),
                'is_visible' => true,
                'published_at' => now()->subDays(3),
            ]
        );

        foreach ($this->youtubeStories() as $index => $youtubeStory) {
            $videoUrl = $this->youtubeWatchUrl($youtubeStory['id']);
            $slug = Str::slug("youtube {$youtubeStory['title']}");

            Video::updateOrCreate(
                ['slug' => $slug],
                [
                    'category_id' => $category->id,
                    'title' => $youtubeStory['title'],
                    'slug' => $slug,
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
