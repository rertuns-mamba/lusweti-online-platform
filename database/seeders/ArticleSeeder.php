<?php

namespace Database\Seeders;

use App\Models\Article;
use App\Models\Category;
use App\Models\Page;
use App\Models\User;
use Database\Seeders\Concerns\UsesPublicStorageMedia;
use Illuminate\Database\Seeder;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class ArticleSeeder extends Seeder
{
    use UsesPublicStorageMedia;

    // Set to true to let Laravel handle the outer transaction if called by DatabaseSeeder,
    // though we are manually handling the inner bulk transaction below.
    public $withinTransaction = true;

    public function run(): void
    {
        $user = User::first() ?? User::factory()->create();
        $page = Page::where('slug', 'general-sports')->first() ?? Page::where('slug', 'home')->first();
        $categories = Category::where('is_active', true)->get();
        $images = $this->publicStorageImages();
        $videos = $this->publicStorageVideos();
        $externalStories = collect($this->externalStories());
        $youtubeStories = collect($this->youtubeStories());

        // Wrap the entire loop in a transaction for massive insert speed gains
        DB::transaction(function () use ($categories, $user, $page, $images, $videos, $externalStories, $youtubeStories) {
            foreach ($categories as $category) {
                for ($index = 0; $index < 12; $index++) {
                    $title = null;
                    try {
                        $kind = $index % 4;
                        $title = $this->titleFor($category, $index, $kind);
                        $slug = Str::slug($title);

                        $article = Article::updateOrCreate(
                            ['slug' => $slug],
                            [
                                'category_id' => $category->id,
                                'page_id' => $page?->id,
                                'user_id' => $user->id,
                                'title' => $title,
                                'summary' => "Dummy {$category->name} coverage seeded from public storage so frontend sections have realistic media.",
                                'content' => '<p>This seeded story is used to exercise the frontend article, hero, video, and external-link layouts.</p>',
                                'topic_label' => $kind === 3 ? 'External' : 'Featured',
                                'content_type' => $kind === 1 || $kind === 2 ? 'video' : 'article',
                                'layout_type' => 'hero',
                                'is_visible' => true,
                                'is_active' => true,
                                'is_youtube' => false,
                                'external_url' => null,
                                'video_url' => null,
                                'featured_image_thumb_url' => null,
                                'image_path' => null,
                                'published_at' => now()->subMinutes(($index + 1) * 11),
                            ]
                        );

                        match ($kind) {
                            1 => $this->seedLocalVideoArticle($article, $videos, $images, $index),
                            // Pass $category explicitly to prevent N+1 queries
                            2 => $this->seedYoutubeArticle($article, $category, $youtubeStories[$index % max($youtubeStories->count(), 1)]),
                            3 => $this->seedExternalArticle($article, $externalStories[$index % max($externalStories->count(), 1)]),
                            default => $this->attachFeaturedImage($article, $images->get($index % max($images->count(), 1))),
                        };
                    } catch (\Throwable $e) {
                        // Log the error natively so it doesn't fail silently if something breaks inside the transaction
                        Log::warning("Failed to seed article: {$title}. Error: {$e->getMessage()}");
                    }
                }
            }
        });
    }

    protected function titleFor(Category $category, int $index, int $kind): string
    {
        $labels = [
            'Photo Essay',
            'Local Video',
            'YouTube Highlight',
            'External Report',
        ];

        return "{$category->name} {$labels[$kind]} " . ($index + 1);
    }

    /**
     * @param  Collection<int, string>  $videos
     * @param  Collection<int, string>  $images
     */
    protected function seedLocalVideoArticle(Article $article, Collection $videos, Collection $images, int $index): void
    {
        $this->attachLocalVideo(
            $article,
            $videos->get($index % max($videos->count(), 1)),
            $images->get($index % max($images->count(), 1)),
        );
    }

    /**
     * @param  array{id: string, title: string}  $youtubeStory
     */
    protected function seedYoutubeArticle(Article $article, Category $category, array $youtubeStory): void
    {
        $thumbnailUrl = $this->youtubeThumbnailUrl($youtubeStory['id']);

        $article->forceFill([
            // Uses the passed $category object to eliminate the hidden N+1 query
            'title' => "{$category->name} {$youtubeStory['title']}",
            'is_youtube' => true,
            'video_url' => $this->youtubeWatchUrl($youtubeStory['id']),
            'featured_image_thumb_url' => $thumbnailUrl,
            'image_path' => $thumbnailUrl,
        ])->save();
    }

    /**
     * @param  array{url: string, image: string, title: string}  $externalStory
     */
    protected function seedExternalArticle(Article $article, array $externalStory): void
    {
        $article->forceFill([
            'title' => $externalStory['title'],
            'external_url' => $externalStory['url'],
            'featured_image_thumb_url' => $externalStory['image'],
            'image_path' => $externalStory['image'],
            'is_youtube' => false,
            'video_url' => null,
        ])->save();
    }
}
