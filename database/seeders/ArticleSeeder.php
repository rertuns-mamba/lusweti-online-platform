<?php

namespace Database\Seeders;

use App\Models\Article;
use App\Models\Category;
use App\Models\Page;
use App\Models\User;
use Database\Seeders\Concerns\UsesPublicStorageMedia;
use Illuminate\Support\Collection;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class ArticleSeeder extends Seeder
{
    use UsesPublicStorageMedia;

    public function run(): void
    {
        $user = User::first() ?? User::factory()->create();
        $page = Page::where('slug', 'sports')->first() ?? Page::where('slug', 'home')->first();
        $categories = Category::where('is_active', true)->get();
        $images = $this->publicStorageImages();
        $videos = $this->publicStorageVideos();
        $externalStories = collect($this->externalStories());
        $youtubeStories = collect($this->youtubeStories());

        foreach ($categories as $category) {
            for ($index = 0; $index < 12; $index++) {
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
                    2 => $this->seedYoutubeArticle($article, $youtubeStories[$index % $youtubeStories->count()]),
                    3 => $this->seedExternalArticle($article, $externalStories[$index % $externalStories->count()]),
                    default => $this->attachFeaturedImage($article, $images->get($index % max($images->count(), 1))),
                };
            }
        }
    }

    protected function titleFor(Category $category, int $index, int $kind): string
    {
        $labels = [
            'Photo Essay',
            'Local Video',
            'YouTube Highlight',
            'External Report',
        ];

        return "{$category->name} {$labels[$kind]} ".($index + 1);
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
    protected function seedYoutubeArticle(Article $article, array $youtubeStory): void
    {
        $thumbnailUrl = $this->youtubeThumbnailUrl($youtubeStory['id']);

        $article->forceFill([
            'title' => "{$article->category?->name} {$youtubeStory['title']}",
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
