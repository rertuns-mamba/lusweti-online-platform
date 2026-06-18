<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Page;
use App\Models\Category;
use App\Models\User;
use App\Models\Article;
use Illuminate\Support\Str;

class SpotiKenyaSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Core Page Structure
        $sportsPage = Page::updateOrCreate(
            ['slug' => 'sports'],
            ['title' => 'Spoti Kenya', 'bg_color' => '#dc2626', 'text_color' => '#ffffff']
        );

        $user = User::first() ?? User::factory()->create();

        // Define distinct paths for local vs international images - use storage
        $kenyaImagePath = storage_path('app/public/images/kenya_sports.jpg');
        $majuuImagePath = storage_path('app/public/images/majuu_sports.jpeg');
        $fallbackImagePath = storage_path('app/public/images/png-thumb.jpg');

        // Fallback safety checkpoint - warn but don't stop
        if (!file_exists($fallbackImagePath)) {
            $this->command->warn("⚠️ Core fallback image missing at: " . $fallbackImagePath . ", using first available image");
            // Use first available image as fallback
            $availableImages = array_filter([$kenyaImagePath, $majuuImagePath], 'file_exists');
            $fallbackImagePath = !empty($availableImages) ? reset($availableImages) : null;
        }

        // =================================================================
        // BLOCK A: LOCAL SPORTS (Spoti Kenya)
        // =================================================================
        $localCategory = Category::updateOrCreate(
            ['slug' => 'sports'],
            ['name' => 'Sports', 'sort_order' => 2, 'is_active' => true]
        );

        $sportsPage->sections()->updateOrCreate(
            ['component' => 'sections.spoti-kenya'],
            [
                'title' => 'Top Local Sports Block',
                'model_type' => 'App\Models\Article',
                'category_id' => $localCategory->id,
                'limit' => 8,
                'is_active' => true,
                'settings' => ['category_id' => $localCategory->id]
            ]
        );

        // Determine target image for local section
        $localFile = file_exists($kenyaImagePath) ? $kenyaImagePath : $fallbackImagePath;
        $this->seedArticlesForCategory($localCategory, $sportsPage, $user, $localFile, 'Sports', 8);


        // =================================================================
        // BLOCK B: INTERNATIONAL SPORTS (Spoti Majuu)
        // =================================================================
        $majuuCategory = Category::updateOrCreate(
            ['slug' => 'majuu'],
            ['name' => 'Spoti Majuu', 'sort_order' => 3, 'is_active' => true, 'bg_color' => '#1e3a8a', 'text_color' => '#ffffff']
        );

        $sportsPage->sections()->updateOrCreate(
            ['component' => 'sections.spoti-majuu-block'],
            [
                'title' => 'Spoti Majuu Layout Block',
                'model_type' => 'App\Models\Article',
                'category_id' => $majuuCategory->id,
                'limit' => 9,
                'is_active' => true,
                'settings' => ['category_id' => $majuuCategory->id]
            ]
        );

        // Determine target image for international section
        $majuuFile = file_exists($majuuImagePath) ? $majuuImagePath : $fallbackImagePath;
        $this->seedArticlesForCategory($majuuCategory, $sportsPage, $user, $majuuFile, 'Majuu', 9);
    }

    /**
     * Helper logic to quickly seed matching articles for a given category scope
     */

    /**
     * Helper logic to quickly seed matching articles for a given category scope
     */
    private function seedArticlesForCategory($category, $page, $user, $imagePath, $prefix, $count)
    {
        for ($i = 1; $i <= $count; $i++) {
            $title = "Sample BBC Style {$prefix} Headline " . $i;

            $article = Article::updateOrCreate(
                ['slug' => Str::slug($title) . '-' . strtolower($prefix) . '-' . $i],
                [
                    'category_id'  => $category->id,
                    'page_id'      => $page->id,
                    'user_id'      => $user->id,
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
                // Check if this article already has its featured image attached
                if ($article->getMedia('featured_image')->isEmpty()) {
                    try {
                        $article->addMedia($imagePath)
                            ->preservingOriginal()
                            ->toMediaCollection('featured_image');

                        // Update the featured image thumb URL for frontend display
                        $imageUrl = $article->getFirstMediaUrl('featured_image');
                        if ($imageUrl) {
                            $article->update([
                                'featured_image_thumb_url' => $imageUrl,
                                'image_path' => $imageUrl
                            ]);
                        }
                    } catch (\Exception $e) {
                        // Skip media attachment if it fails
                    }
                }
            }
        }
    }
   
}
