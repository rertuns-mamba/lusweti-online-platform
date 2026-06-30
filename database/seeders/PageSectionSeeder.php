<?php

namespace Database\Seeders;

use App\Models\Article;
use App\Models\Category;
use App\Models\Page;
use App\Models\PageSection;
use App\Models\User;
use Database\Seeders\Concerns\UsesPublicStorageMedia;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class PageSectionSeeder extends Seeder
{
    use UsesPublicStorageMedia;

    /**
     * Set to false to accommodate Spatie Media Library file handling 
     * or large dataset transactions if needed.
     */
    public $withinTransaction = false;

    /**
     * In-memory cache to prevent redundant database hits for categories.
     *
     * @var array<string, int>
     */
    protected array $categoryMap = [];

    /**
     * The default user assigned to seeded articles.
     * * @var User
     */
    protected User $defaultUser;

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // 1. Ensure we have a default user for content attribution
        $this->defaultUser = User::first() ?? User::factory()->create();

        // 2. Warm up the category lookup cache map
        $this->initializeCategories();

        // 3. Seed Pages and their respective sections
        $this->seedHomePage();
        $this->seedSportsKenyaPage();
        $this->seedSportsMajuuPage();
        $this->seedHadithiPage();
        $this->seedBurudaniPage();
    }

    /**
     * Pre-populate and cache essential categories to optimize queries.
     */
    protected function initializeCategories(): void
    {
        $explicitCategories = [
            // 'sports' => ['name' => 'Sports', 'sort_order' => 2],
            'sports-kenya' => ['name' => 'Kenya Sports'],
            'burudani' => ['name' => 'Burudani '],
            'spoti-majuu' => [
                'name' => 'International Sports',
                'sort_order' => 3,
                'bg_color' => '#1e3a8a',
                'text_color' => '#ffffff'
            ],
            'videos' => ['name' => 'Videos'],
            'gallery' => ['name' => 'Galleries'],
        ];

        // Seed core categories with explicit attributes first
        foreach ($explicitCategories as $slug => $data) {
            $attributes = array_merge([
                'name' => $data['name'],
                'title' => $data['name'],
                'is_active' => true,
            ], $data);

            $category = Category::updateOrCreate(['slug' => $slug], $attributes);
            $this->categoryMap[$slug] = $category->id;
        }

        // Map any already existing categories to prevent duplicates
        Category::all()->each(function (Category $category) {
            $this->categoryMap[$category->slug] = $category->id;
        });
    }

    /**
     * Safely fetch or runtime-create category IDs without N+1 query issues.
     */
    protected function getCategoryId(string $slug): int
    {
        if (isset($this->categoryMap[$slug])) {
            return $this->categoryMap[$slug];
        }

        $category = Category::updateOrCreate(
            ['slug' => $slug],
            [
                'name' => ucwords(str_replace('-', ' ', $slug)),
                'title' => ucwords(str_replace('-', ' ', $slug)),
                'is_active' => true,
            ]
        );

        $this->categoryMap[$slug] = $category->id;

        return $category->id;
    }

    /**
     * Seed the Home Page, its configuration sections, and media examples.
     */
    protected function seedHomePage(): void
    {
        $homePage = Page::updateOrCreate(
            ['slug' => 'general-sports'],
            ['title' => 'Home', 'is_active' => true, 'nav_order' => 1, 'show_in_nav' => true]
        );

        $homeSections = [
            [
                'title' => 'Latest Sports Highlights',
                'category_id' => $this->getCategoryId('general-sports'),
                'layout_type' => 'sections.hero',
                'component' => 'sections.hero',
                'model_type' => Article::class,
                'limit' => 10,
                'sort_order' => 1,
                'is_active' => true,
                'is_visible' => true,
            ],



             [
                'title' => 'International Sports',
                'category_id' => $this->getCategoryId('spoti-majuu'),
                'layout_type' => 'sections.spoti-majuu-block',
                'component' => 'sections.spoti-majuu-block',
                'model_type' => Article::class,
                'limit' => 10,
                'sort_order' => 2,
                'is_active' => true,
                'is_visible' => true,
            ],
            [
                'title' => 'Sports News',
                'category_id' => $this->getCategoryId('business'),
                'layout_type' => 'sections.editorial-grid-block',
                'component' => 'sections.editorial-grid-block',
                'model_type' => Article::class,
                'limit' => 9,
                'sort_order' => 2,
                'is_active' => true,
                'is_visible' => true,
            ],
            

            [
                'title' => 'Most Featured',
                'component' => 'sections.most-featured', // ✨ Updated to match what your frontend expects
                'model_type' => Article::class,
                'category_id' => $this->getCategoryId('most-featured'),
                'limit' => 10,
                'sort_order' => 3,
                'is_active' => true,
                'settings' => ['show_sidebar' => true, 'show_video' => false],
            ],

            
            [
                'title' => 'Galla Sports',
                'component' => 'sections.latest-in-gallery',
                'model_type' => Article::class,
                'category_id' => $this->getCategoryId('latest-in-gallery'),
                'limit' => 9,
                'sort_order' => 3, // Fixed ordering collision
                'is_active' => true,
            ],           
           
           
            [
                'title' => 'Video Highlights',
                'category_id' => $this->getCategoryId('videos'),
                'layout_type' => 'sections.videos',
                'component' => 'sections.videos',
                'model_type' => Article::class,
                'limit' => 9,
                'sort_order' => 4,
                'is_active' => true,
                'is_visible' => true,
            ],
        ];

        foreach ($homeSections as $section) {
            // PRO TIP: Match on 'component' so sections never clobber each other
            PageSection::updateOrCreate(
                [
                    'page_id' => $homePage->id,
                    'component' => $section['component'],
                ],
                $section
            );
        }

        $this->seedHeroArticles();
    }

    /**
     * Seed the Sports Page and its child content stack layout blocks.
     */
    protected function seedSportsKenyaPage(): void
    {
        $sportsKenyaPage = Page::updateOrCreate(
            ['slug' => 'sports-kenya'],
            ['title' => 'Sports Kenya', 'bg_color' => '#dc2626', 'text_color' => '#ffffff', 'nav_order' => 2, 'show_in_nav' => true]
        );

        $sportsKenyaSections = [
            [
                'title' => 'Top Local Sports Block',
                'component' => 'sections.spoti-kenya',
                'model_type' => Article::class,
                'category_id' => $this->getCategoryId('spoti-kenya'),
                'limit' => 8,
                'sort_order' => 1,
                'is_active' => true,
                'settings' => ['category_id' => $this->getCategoryId('spoti-kenya')],
            ],
            [
                'title' => 'Most Featured',
                'component' => 'sections.most-featured', // ✨ Updated to match what your frontend expects
                'model_type' => Article::class,
                'category_id' => $this->getCategoryId('most-featured'),
                'limit' => 8,
                'sort_order' => 2,
                'is_active' => true,
                'settings' => ['show_sidebar' => true, 'show_video' => false],
            ],
            // [
            //     'title' => 'Video Highlights',
            //     'component' => 'sections.videos',
            //     'model_type' => Article::class,
            //     'category_id' => $this->getCategoryId('videos'),
            //     'limit' => 9,
            //     'sort_order' => 5,
            //     'is_active' => true,
            // ],
            [
                'title' => 'Gallery Highlights',
                'component' => 'sections.galleries',
                'model_type' => Article::class,
                'category_id' => $this->getCategoryId('gallery'),
                'limit' => 9,
                'sort_order' => 6,
                'is_active' => true,
            ],
        ];

        foreach ($sportsKenyaSections as $section) {
            $sportsKenyaPage->sections()->updateOrCreate(['title' => $section['title']], $section);
        }

        // Generate the underlying articles for the Spoti Kenya grid
        $imagePath = $this->resolveImagePath('kenya_sports.jpg');
        $this->seedCategoryArticles($this->getCategoryId('spoti-kenya'), $sportsKenyaPage, $imagePath, 'Sports', 8);
    }

    protected function seedSportsMajuuPage(): void
    {
        $sportsMajuuPage = Page::updateOrCreate(['slug' => 'sports-majuu'], ['title' => 'Sports Majuu', 'nav_order' => 3, 'show_in_nav' => true]);

        $sportsMajuuSections = [
            [
                'title' => 'International Sports',
                'component' => 'sections.spoti-majuu-block',
                'model_type' => Article::class,
                'category_id' => $this->getCategoryId('spoti-majuu'),
                'limit' => 9,
                'sort_order' => 3,
                'is_active' => true,
                'settings' => ['category_id' => $this->getCategoryId('spoti-majuu')],
            ],
            [
                'title' => 'Most Featured',
                'component' => 'sections.most-featured', // ✨ Updated to match what your frontend expects
                'model_type' => Article::class,
                'category_id' => $this->getCategoryId('most-featured'),
                'limit' => 9,
                'sort_order' => 5,
                'is_active' => true,
                'settings' => ['show_sidebar' => true, 'show_video' => false],
            ],
            [
                'title' => 'Gallery Highlights',
                'component' => 'sections.galleries',
                'model_type' => Article::class,
                'category_id' => $this->getCategoryId('gallery'),
                'limit' => 9,
                'sort_order' => 6,
                'is_active' => true,
            ],
        ];

        foreach ($sportsMajuuSections as $section) {
            $sportsMajuuPage->sections()->updateOrCreate(['title' => $section['title']], $section);
        }

        // Generate the underlying articles for the Majuu grid
        $imagePath = $this->resolveImagePath('majuu_sports.jpeg');
        $this->seedCategoryArticles($this->getCategoryId('spoti-majuu'), $sportsMajuuPage, $imagePath, 'Majuu', 9);
    }



     protected function seedBurudaniPage(): void
    {
        $burudaniPage = Page::updateOrCreate(['slug' => 'burudani'], ['title' => 'Burudani', 'nav_order' => 4, 'show_in_nav' => true]);

        $burudaniSections = [
            [
                'title' => 'Sports News',
                'category_id' => $this->getCategoryId('business'),
                'layout_type' => 'sections.editorial-grid-block',
                'component' => 'sections.editorial-grid-block',
                'model_type' => Article::class,
                'limit' => 7,
                'sort_order' => 1,
                'is_active' => true,
                'is_visible' => true,
            ],

          [
                'title' => 'Latest Sports Highlights',
                'category_id' => $this->getCategoryId('general-sports'),
                'layout_type' => 'sections.hero',
                'component' => 'sections.hero',
                'model_type' => Article::class,
                'limit' => 10,
                'sort_order' => 1,
                'is_active' => true,
                'is_visible' => true,
            ],
            
            [
                'title' => 'Burudani',
                'component' => 'sections.most-featured',
                'model_type' => Article::class,
                'category_id' => $this->getCategoryId('most-featured'),
                'limit' => 10,
                'sort_order' => 2,
                'is_active' => true,
                'settings' => ['show_sidebar' => true, 'show_video' => false],
            ],           


           
            [
                'title' => 'Gallery Highlights',
                'component' => 'sections.galleries',
                'model_type' => Article::class,
                'category_id' => $this->getCategoryId('gallery'),
                'limit' => 9,
                'sort_order' => 6,
                'is_active' => true,
            ],
        ];

        foreach ($burudaniSections as $section) {
            $burudaniPage->sections()->updateOrCreate(['title' => $section['title']], $section);
        }

        // Generate the underlying articles for the Majuu grid
        $imagePath = $this->resolveImagePath('majuu_sports.jpeg');
        $this->seedCategoryArticles($this->getCategoryId('spoti-majuu'), $burudaniPage, $imagePath, 'Majuu', 9);
    }


    /**
     * Seed the Hadithi Page and its layout component collection.
     */
    protected function seedHadithiPage(): void
    {
        $hadithiPage = Page::updateOrCreate(['slug' => 'hadithi'], ['title' => 'Hadithi', 'nav_order' => 5, 'show_in_nav' => true]);

        $hadithiSections = [
            [
                'title' => 'Hadithi Latest',
                'component' => 'sections.hadithi-grid',
                'model_type' => Article::class,
                'category_id' => $this->getCategoryId('hadithi'),
                'limit' => 10,
                'sort_order' => 1,
                'is_active' => true,
            ],
             [
                'title' => 'Most Featured',
                'component' => 'sections.most-featured', // ✨ Updated to match what your frontend expects
                'model_type' => Article::class,
                'category_id' => $this->getCategoryId('most-featured'),
                'limit' => 10,
                'sort_order' => 2,
                'is_active' => true,
                'settings' => ['show_sidebar' => true, 'show_video' => false],
            ],
            [
                'title' => 'Gallery Highlights',
                'component' => 'sections.galleries',
                'model_type' => Article::class,
                'category_id' => $this->getCategoryId('gallery'),
                'limit' => 9,
                'sort_order' => 1,
                'is_active' => true,
            ],
            [
                'title' => 'Video Highlights',
                'component' => 'sections.videos',
                'model_type' => Article::class,
                'category_id' => $this->getCategoryId('videos'),
                'limit' => 9,
                'sort_order' => 2,
                'is_active' => true,
            ],
        ];

        foreach ($hadithiSections as $section) {
            $hadithiPage->sections()->updateOrCreate(['title' => $section['title']], $section);
        }
    }

    /**
     * Handle the complex polymorphic variations of core Hero Articles.
     */
    protected function seedHeroArticles(): void
    {
        $images = $this->publicStorageImages();
        $videos = $this->publicStorageVideos();

        $externalStory = $this->externalStories()[0] ?? null;
        $youtubeStory = $this->youtubeStories()[0] ?? null;

        // Article variation 1: Local Image Story
        $imageArticle = $this->upsertHeroArticle(
            $this->getCategoryId('sports'),
            'Kenya Sports Triumphs: Record-Breaking Performance',
            'A lead image story powered by a local public/storage image.',
            1
        );
        if ($images && $images->isNotEmpty()) {
            $this->attachFeaturedImage($imageArticle, $images->first());
        }

        // Article variation 2: Local Video Attached Story
        $localVideoArticle = $this->upsertHeroArticle(
            $this->getCategoryId('sports'),
            'Exclusive Pitchside Highlights',
            'A local MP4 story attached through Spatie Media Library.',
            2
        );
        if ($videos && $images && $videos->isNotEmpty() && $images->isNotEmpty()) {
            $this->attachLocalVideo($localVideoArticle, $videos->first(), $images->first());
        }
        $localVideoArticle->forceFill(['content_type' => 'video'])->save();

        // Article variation 3: Embedded YouTube Video URL Story
        if ($youtubeStory) {
            $youtubeArticle = $this->upsertHeroArticle(
                $this->getCategoryId('videos'),
                $youtubeStory['title'],
                'A YouTube dummy item for embedded frontend playback.',
                3
            );
            $youtubeArticle->forceFill([
                'is_youtube' => true,
                'video_url' => $this->youtubeWatchUrl($youtubeStory['id']),
                'featured_image_thumb_url' => $this->youtubeThumbnailUrl($youtubeStory['id']),
                'image_path' => $this->youtubeThumbnailUrl($youtubeStory['id']),
                'content_type' => 'video',
            ])->save();
        }

        // Article variation 4: External URL Open Graph Mapping Story
        if ($externalStory) {
            $externalArticle = $this->upsertHeroArticle(
                $this->getCategoryId('sports'),
                $externalStory['title'],
                'An external URL story populated with a seeded OG image URL.',
                4
            );
            $externalArticle->forceFill([
                'external_url' => $externalStory['url'],
                'featured_image_thumb_url' => $externalStory['image'],
                'image_path' => $externalStory['image'],
            ])->save();
        }
    }

    /**
     * Main helper abstraction to update/create standard structural attributes for hero nodes.
     */
    protected function upsertHeroArticle(int $categoryId, string $title, string $summary, int $minutesAgo): Article
    {
        return Article::updateOrCreate(
            ['slug' => Str::slug($title)],
            [
                'category_id' => $categoryId,
                'user_id' => $this->defaultUser->id,
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

    /**
     * Helper logic to quickly seed matching articles for a given category scope and attach Spatie media.
     */
    protected function seedCategoryArticles(int $categoryId, Page $page, ?string $imagePath, string $prefix, int $count): void
    {
        for ($i = 1; $i <= $count; $i++) {
            $title = "Sample BBC Style {$prefix} Headline " . $i;

            $article = Article::updateOrCreate(
                ['slug' => Str::slug($title) . '-' . strtolower($prefix) . '-' . $i],
                [
                    'category_id'  => $categoryId,
                    'page_id'      => $page->id,
                    'user_id'      => $this->defaultUser->id,
                    'title'        => $title,
                    'summary'      => "Compelling summary statement built for the {$prefix} sports grid section. It scales over lines perfectly.",
                    'content'      => "<p>Full editorial analysis and commentary details go here.</p>",
                    'topic_label'  => $prefix === 'Majuu' ? 'International' : 'Breaking',
                    'content_type' => 'article',
                    'is_visible'   => true,
                    'is_active'    => true,
                    'published_at' => now()->subMinutes($i * 20),
                ]
            );

            // OPTIMIZED: Handle Media without choking the CPU on updates
            if (method_exists($article, 'addMedia') && $imagePath && file_exists($imagePath)) {
                if ($article->getMedia('featured_image')->isEmpty()) {
                    try {
                        $article->addMedia($imagePath)
                            ->preservingOriginal()
                            ->toMediaCollection('featured_image');

                        $imageUrl = $article->getFirstMediaUrl('featured_image');
                        if ($imageUrl) {
                            $article->update([
                                'featured_image_thumb_url' => $imageUrl,
                                'image_path' => $imageUrl
                            ]);
                        }
                    } catch (\Exception $e) {
                        // Silently skip media attachment if it fails
                    }
                }
            }
        }
    }

    /**
     * Safely resolve image paths with a built-in fallback sequence.
     */
    protected function resolveImagePath(string $targetFilename): ?string
    {
        $targetPath = storage_path('app/public/images/' . $targetFilename);
        $fallbackPath = storage_path('app/public/images/png-thumb.jpg');

        if (file_exists($targetPath)) {
            return $targetPath;
        }

        if (file_exists($fallbackPath)) {
            return $fallbackPath;
        }

        // Warn gracefully but do not kill the seeding process
        $this->command->warn("⚠️ Target image [{$targetFilename}] and fallback [png-thumb.jpg] missing.");

        // As a final resort, grab the first available image in the directory
        $availableImages = glob(storage_path('app/public/images/*.*'));

        return !empty($availableImages) ? $availableImages[0] : null;
    }
}
