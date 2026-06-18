<?php


namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Page;
use App\Models\PageSection;
use App\Models\Category;
use App\Models\Article;
use Illuminate\Support\Str;

class HeroContentSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Build Category Dictionary to prevent N+1 DB calls
        $categoriesData = [
            'sports'       => 'Sports',
            'business'     => 'Business & Technology',
            'spoti-majuu'  => 'International Sports',
            'videos'       => 'Videos',
            'gallery'      => 'Galleries',
        ];

        $categoryMap = [];
        foreach ($categoriesData as $slug => $name) {
            $category = Category::updateOrCreate(
                ['slug' => $slug],
                ['name' => $name, 'is_active' => true]
            );
            $categoryMap[$slug] = $category->id;
        }

        // 2. Define the Home Page Entity (Database Identifier = 'home')
        $homePage = Page::updateOrCreate(
            ['slug' => 'home'],
            ['title' => 'Home Page', 'is_active' => true]
        );

        // 3. Define Section Blueprints
        $homeSections = [
            [
                'title'       => 'Latest Sports Highlights',
                'category_id' => $categoryMap['sports'] ?? null, 
                'layout_type' => 'sections.hero',
                'component'   => 'sections.hero',
                'is_active'   => true,
                'sort_order'  => 1
            ],
            [
                'title'       => 'Technology News',
                'category_id' => $categoryMap['business'] ?? null,
                'layout_type' => 'sections.editorial-grid-block',
                'component'   => 'sections.editorial-grid-block',
                'model_type'  => Article::class,
                'limit'       => 9,
                'sort_order'  => 2,
                'is_active'   => true,
            ],
            [
                'title'       => 'International Sports',
                'category_id' => $categoryMap['spoti-majuu'] ?? null,
                'layout_type' => 'sections.spoti-majuu-block',
                'component'   => 'sections.spoti-majuu-block',
                'model_type'  => Article::class,
                'limit'       => 9,
                'sort_order'  => 3,
                'is_active'   => true,
            ],
            [
                'title'       => 'Video Highlights',
                'category_id' => $categoryMap['videos'] ?? null,
                'layout_type' => 'sections.videos',
                'component'   => 'sections.videos',
                'model_type'  => Article::class,
                'limit'       => 9,
                'sort_order'  => 4,
                'is_active'   => true,
            ],
            [
                'title'       => 'Gallery Highlights',
                'category_id' => $categoryMap['gallery'] ?? null,
                'layout_type' => 'sections.galleries',
                'component'   => 'sections.galleries',
                'model_type'  => Article::class,
                'limit'       => 9,
                'sort_order'  => 5,
                'is_active'   => true,
            ],
        ];

        // Process sections idempotently
        foreach ($homeSections as $section) {
            PageSection::updateOrCreate(
                [
                    'page_id'     => $homePage->id, 
                    'layout_type' => $section['layout_type']
                ], 
                $section
            );
        }

        // Cache file paths - use local files from storage
        $imagePath = storage_path('app/public/images/kenya_sports.jpg');
        $videoPath = storage_path('app/public/videos/mp4.mp4');

        // 4. Seed Hero Media Content
        $imageArticle = Article::updateOrCreate(
            ['slug' => Str::slug('Kenya Sports Triumphs Record Breaking Performance')],
            [
                'category_id'  => $categoryMap['sports'],
                'title'        => 'Kenya Sports Triumphs: Record-Breaking Performance',
                'is_active'    => true,
                'published_at' => now(),
            ]
        );

        if (file_exists($imagePath) && !$imageArticle->hasMedia('images')) {
            try {
                $imageArticle->addMedia($imagePath)->preservingOriginal()->toMediaCollection('images');
                $imageUrl = $imageArticle->getFirstMediaUrl('images');
                if ($imageUrl) {
                    $imageArticle->update([
                        'featured_image_thumb_url' => $imageUrl,
                        'image_path' => $imageUrl
                    ]);
                }
            } catch (\Exception $e) {
                $this->command->warn("Could not attach image to article: " . $e->getMessage());
            }
        }

        $videoArticle = Article::updateOrCreate(
            ['slug' => Str::slug('Exclusive Pitchside Highlights')],
            [
                'category_id'  => $categoryMap['sports'],
                'title'        => 'Exclusive Pitchside Highlights',
                'is_youtube'   => false,
                'is_active'    => true,
                'published_at' => now()->subMinutes(5),
            ]
        );

        if (file_exists($videoPath) && !$videoArticle->hasMedia('videos')) {
            try {
                $videoArticle->addMedia($videoPath)->preservingOriginal()->toMediaCollection('videos');
                $videoArticle->update([
                    'video_url'  => $videoArticle->getFirstMediaUrl('videos'),
                    'image_path' => $imageArticle->getFirstMediaUrl('images')
                ]);
            } catch (\Exception $e) {
                $this->command->warn("Could not attach video to article (FFmpeg may not be configured): " . $e->getMessage());
            }
        }
    }
}