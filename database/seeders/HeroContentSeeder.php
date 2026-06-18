<?php

namespace Database\Seeders;

use App\Models\Article;
use App\Models\Category;
use App\Models\Page;
use App\Models\PageSection;
use Database\Seeders\Concerns\UsesPublicStorageMedia;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class HeroContentSeeder extends Seeder
{
    use UsesPublicStorageMedia;

    public function run(): void
    {
        $categoryMap = $this->seedCategories();
        $homePage = Page::updateOrCreate(
            ['slug' => 'home'],
            ['title' => 'Home Page', 'is_active' => true]
        );

        $this->seedHomeSections($homePage, $categoryMap);
        $this->seedHeroArticles($categoryMap);
    }

    /**
     * @return array<string, int>
     */
    protected function seedCategories(): array
    {
        $categoriesData = [
            'sports' => 'Sports',
            'business' => 'Business & Technology',
            'spoti-majuu' => 'International Sports',
            'videos' => 'Videos',
            'gallery' => 'Galleries',
        ];

        $categoryMap = [];

        foreach ($categoriesData as $slug => $name) {
            $category = Category::updateOrCreate(
                ['slug' => $slug],
                ['name' => $name, 'title' => $name, 'is_active' => true]
            );

            $categoryMap[$slug] = $category->id;
        }

        return $categoryMap;
    }

    /**
     * @param  array<string, int>  $categoryMap
     */
    protected function seedHomeSections(Page $homePage, array $categoryMap): void
    {
        $homeSections = [
            [
                'title' => 'Latest Sports Highlights',
                'category_id' => $categoryMap['sports'],
                'layout_type' => 'sections.hero',
                'component' => 'sections.hero',
                'model_type' => Article::class,
                'limit' => 7,
                'sort_order' => 1,
                'is_active' => true,
                'is_visible' => true,
            ],
            [
                'title' => 'Technology News',
                'category_id' => $categoryMap['business'],
                'layout_type' => 'sections.editorial-grid-block',
                'component' => 'sections.editorial-grid-block',
                'model_type' => Article::class,
                'limit' => 9,
                'sort_order' => 2,
                'is_active' => true,
                'is_visible' => true,
            ],
            [
                'title' => 'International Sports',
                'category_id' => $categoryMap['spoti-majuu'],
                'layout_type' => 'sections.spoti-majuu-block',
                'component' => 'sections.spoti-majuu-block',
                'model_type' => Article::class,
                'limit' => 9,
                'sort_order' => 3,
                'is_active' => true,
                'is_visible' => true,
            ],
            [
                'title' => 'Video Highlights',
                'category_id' => $categoryMap['videos'],
                'layout_type' => 'sections.videos',
                'component' => 'sections.videos',
                'model_type' => Article::class,
                'limit' => 9,
                'sort_order' => 4,
                'is_active' => true,
                'is_visible' => true,
            ],
            [
                'title' => 'Gallery Highlights',
                'category_id' => $categoryMap['gallery'],
                'layout_type' => 'sections.galleries',
                'component' => 'sections.galleries',
                'model_type' => Article::class,
                'limit' => 9,
                'sort_order' => 5,
                'is_active' => true,
                'is_visible' => true,
            ],
        ];

        foreach ($homeSections as $section) {
            PageSection::updateOrCreate(
                [
                    'page_id' => $homePage->id,
                    'layout_type' => $section['layout_type'],
                ],
                $section
            );
        }
    }

    /**
     * @param  array<string, int>  $categoryMap
     */
    protected function seedHeroArticles(array $categoryMap): void
    {
        $images = $this->publicStorageImages();
        $videos = $this->publicStorageVideos();
        $externalStory = $this->externalStories()[0];
        $youtubeStory = $this->youtubeStories()[0];

        $imageArticle = $this->upsertHeroArticle(
            $categoryMap['sports'],
            'Kenya Sports Triumphs: Record-Breaking Performance',
            'A lead image story powered by a local public/storage image.',
            1,
        );
        $this->attachFeaturedImage($imageArticle, $images->first());

        $localVideoArticle = $this->upsertHeroArticle(
            $categoryMap['sports'],
            'Exclusive Pitchside Highlights',
            'A local MP4 story attached through Spatie Media Library.',
            2,
        );
        $this->attachLocalVideo($localVideoArticle, $videos->first(), $images->first());
        $localVideoArticle->forceFill([
            'content_type' => 'video',
        ])->save();

        $youtubeArticle = $this->upsertHeroArticle(
            $categoryMap['videos'],
            $youtubeStory['title'],
            'A YouTube dummy item for embedded frontend playback.',
            3,
        );
        $youtubeArticle->forceFill([
            'is_youtube' => true,
            'video_url' => $this->youtubeWatchUrl($youtubeStory['id']),
            'featured_image_thumb_url' => $this->youtubeThumbnailUrl($youtubeStory['id']),
            'image_path' => $this->youtubeThumbnailUrl($youtubeStory['id']),
            'content_type' => 'video',
        ])->save();

        $externalArticle = $this->upsertHeroArticle(
            $categoryMap['sports'],
            $externalStory['title'],
            'An external URL story populated with a seeded OG image URL.',
            4,
        );
        $externalArticle->forceFill([
            'external_url' => $externalStory['url'],
            'featured_image_thumb_url' => $externalStory['image'],
            'image_path' => $externalStory['image'],
        ])->save();
    }

    protected function upsertHeroArticle(int $categoryId, string $title, string $summary, int $minutesAgo): Article
    {
        return Article::updateOrCreate(
            ['slug' => Str::slug($title)],
            [
                'category_id' => $categoryId,
                'title' => $title,
                'summary' => $summary,
                'content' => '<p>This hero seed exists so the frontend always has local, YouTube, and external media examples.</p>',
                'topic_label' => 'Hero',
                'content_type' => 'article',
                'layout_type' => 'hero',
                'is_visible' => true,
                'is_active' => true,
                'is_youtube' => false,
                'external_url' => null,
                'video_url' => null,
                'featured_image_thumb_url' => null,
                'image_path' => null,
                'published_at' => now()->subMinutes($minutesAgo),
            ]
        );
    }
}
