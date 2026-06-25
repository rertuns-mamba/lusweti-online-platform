<?php

namespace Database\Seeders;

use App\Models\Article;
use App\Models\Category;
use App\Models\Gallery;
use App\Models\Page;
use Database\Seeders\Concerns\UsesPublicStorageMedia;
use Illuminate\Database\Seeder;
use Throwable;

class GalleryGridSeeder extends Seeder
{
    use UsesPublicStorageMedia;

    public $withinTransaction = false;

    public function run(): void
    {
        $page = Page::updateOrCreate(
            ['slug' => 'galleries'],
            [
                'title' => 'Gallery',
                'bg_color' => '#7c3aed',
                'text_color' => '#ffffff',
                'show_in_nav' => true,
                'nav_order' => 6,
            ]
        );

        $category = Category::updateOrCreate(
            ['slug' => 'galleries'],
            [
                'name' => 'Galleries',
                'title' => 'Photo Galleries',
                'is_active' => true,
            ]
        );

        $page->sections()->updateOrCreate(
            ['component' => 'sections.galleries'],
            [
                'title' => 'Photo Galleries',
                'category_id' => $category->id,
                'layout_type' => 'sections.galleries',
                'model_type' => Gallery::class,
                'limit' => 4,
                'sort_order' => 1,
                'is_active' => true,
                'is_visible' => true,
                'settings' => [
                    'category_id' => $category->id,
                    'limit' => 4,
                    'subtitle' => 'Browse stunning photo collections',
                ],
            ]
        );

        // Add editorial grid block for gallery-related articles
        $newsCategory = Category::updateOrCreate(
            ['slug' => 'gallery-news'],
            [
                'name' => 'Gallery News',
                'title' => 'Gallery News',
                'is_active' => true,
            ]
        );

        $page->sections()->updateOrCreate(
            ['component' => 'sections.editorial-grid-block'],
            [
                'title' => 'Gallery News',
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
            ['slug' => 'gallery-news-local-image'],
            [
                'category_id' => $newsCategory->id,
                'title' => 'Local Image Gallery Article',
                'slug' => 'gallery-news-local-image',
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
            ['slug' => 'gallery-news-external-url'],
            [
                'category_id' => $newsCategory->id,
                'title' => $externalStories[1]['title'],
                'slug' => 'gallery-news-external-url',
                'summary' => 'External article from news source',
                'external_url' => $externalStories[1]['url'],
                'featured_image_thumb_url' => $externalStories[1]['image'],
                'is_visible' => true,
                'published_at' => now()->subDays(2),
            ]
        );

        // Article with YouTube video
        Article::updateOrCreate(
            ['slug' => 'gallery-news-youtube'],
            [
                'category_id' => $newsCategory->id,
                'title' => 'YouTube Video Gallery Article',
                'slug' => 'gallery-news-youtube',
                'summary' => 'Article embedded with YouTube video',
                'content' => 'This article contains an embedded YouTube video.',
                'is_youtube' => true,
                'video_url' => $this->youtubeWatchUrl('kJQP7kiw5Fk'),
                'is_visible' => true,
                'published_at' => now()->subDays(3),
            ]
        );

        foreach ($images as $index => $imagePath) {
            $gallery = Gallery::updateOrCreate(
                ['slug' => "gallery-{$index}"],
                [
                    'category_id' => $category->id,
                    'title' => 'Photo Gallery '.($index + 1),
                    'slug' => "gallery-{$index}",
                    'is_visible' => true,
                    'published_at' => now()->subDays($index),
                ]
            );

            try {
                if (! $gallery->hasMedia('gallery_cover')) {
                    $gallery
                        ->addMedia($imagePath)
                        ->preservingOriginal()
                        ->toMediaCollection('gallery_cover');
                }
            } catch (Throwable) {
                // Keep the gallery even if media attachment fails.
            }
        }

        $this->command->info('Gallery Grid Architecture Seeded Successfully!');
    }
}
