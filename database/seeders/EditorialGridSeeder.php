<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Page;
use App\Models\Category;
use App\Models\Article;
use Illuminate\Support\Str;
use Throwable;

class EditorialGridSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Create the Page (Controls Layout & Colors)
        $page = Page::updateOrCreate(
            ['slug' => 'burudani'],
            [
                'title' => 'Burudani (Entertainment)', // Changed from 'name' to match your architectural Page model
                'bg_color' => '#8b5cf6',
                'text_color' => '#ffffff',
            ]
        );

        // 2. Create the Category (Controls Taxonomy & Data)
        $category = Category::updateOrCreate(
            ['slug' => 'music-culture'],
            [
                'name' => 'Music & Culture',
                'is_active' => true,
            ]
        );

        // 3. Attach the Section to the Page
        $page->sections()->updateOrCreate(
            ['component' => 'editorial-grid'],
            [
                'sort_order' => 1,
                'is_active' => true, // Changed from 'is_visible' to match your page_sections schema
                'settings' => [
                    'category_id' => $category->id,
                    'limit' => 5
                ]
            ]
        );

        // 4. Seed 5 Articles for the layout
        for ($i = 1; $i <= 5; $i++) {
            $article = Article::updateOrCreate(
                ['slug' => "burudani-culture-update-{$i}"],
                [
                    'category_id' => $category->id,
                    'content_type' => 'article',
                    'title' => "Major cultural festival announced for this weekend (Update {$i})",
                    'summary' => 'Organizers have released the official lineup, promising a mix of legendary artists and upcoming local talent across multiple stages.',
                    'is_prime' => $i === 2,
                    'is_visible' => true,
                    'published_at' => now()->subHours($i * 2),
                    'image_path' => 'assets/images/fallback-placeholder.jpg', // Structural fallback
                ]
            );

            // 5. Defensive Media Asset Attacher
            if ($article->getMedia('featured_image')->count() === 0) {
                try {
                    // Try to fetch remote image assets
                    $localPath = public_path("assets/seeders/article-{$i}.jpg");

                    if (file_exists($localPath)) {
                        $article->addMedia($localPath)
                            ->preservingOriginal() // CRUCIAL: Keeps your seed files intact for the next fresh migration run
                            ->toMediaCollection('featured_image');
                    } else {
                        // Ultimate text-only fallback if the local file isn't found
                        $article->addMediaFromUrl("https://placehold.co/800x450/111827/FFFFFF/png?text=Placeholder")
                            ->toMediaCollection('featured_image');
                    }
                    // $article->addMediaFromUrl('https://picsum.photos/seed/culture' . $i . '/800/450')
                    //     ->toMediaCollection('featured_image');
                } catch (Throwable $e) {
                    // Catch network timeouts or rate limits gracefully without stopping execution
                    $this->command->warn(" Skipping network image for Article {$i} (URL Unreachable). Using local fallback.");
                }
            }
        }

        $this->command->info('Editorial Grid Architecture Seeded Successfully!');
    }
}
