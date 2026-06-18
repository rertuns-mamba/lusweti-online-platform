<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Page;
use App\Models\Category;

class PageSectionSeeder extends Seeder
{
    public function run(): void
    {
        // Fetch all categories once.
        $cats = Category::all()->keyBy('slug');
        
        // Inside PageSectionSeeder.php
        $getCatId = function ($slug) {
            $category = Category::where('slug', $slug)->first();

            // If it doesn't exist, create it so the seed doesn't crash
            if (!$category) {
                $category = Category::create([
                    'name' => ucwords(str_replace('-', ' ', $slug)),
                    'slug' => $slug,
                    'is_active' => true
                ]);
            }
            return $category->id;
        };

        

        // ==========================================
        // 2. THE SPORTS PAGE
        // ==========================================
        $sportsPage = Page::updateOrCreate(['slug' => 'sports'], ['title' => 'Sports']);

        $sportsSections = [

            [
                'title'       => 'Top Stories',
                'component'   => 'sections.hero',
                'model_type'  => 'App\Models\Article',
                'category_id' => $getCatId('hero'),
                'limit'       => 10,
                'sort_order'  => 1,
                'is_active'   => true,
                'settings'    => ['show_sidebar' => true, 'show_video' => true],
            ],
            [
                'title'       => 'Spoti Kenya',
                'component'   => 'sections.magazine-home',
                'model_type'  => 'App\Models\Article',
                'category_id' => $getCatId('magazine'),
                'limit'       => 10,
                'sort_order'  => 2,
                'is_active'   => true,
                'settings'    => ['show_sidebar' => true, 'show_video' => false],
            ],
            [
                'title'       => 'Video Highlights',
                'component'   => 'sections.videos',
                'model_type'  => 'App\Models\Article',
                'category_id' => $getCatId('videos'),
                'limit'       => 9,
                'sort_order'  => 5,
                'is_active'   => true,
            ],
            [
                'title'       => 'International Sports',
                'component'   => 'sections.spoti-majuu-block',
                'model_type'  => 'App\Models\Article',
                'category_id' => $getCatId('spoti-majuu'),
                'limit'       => 9,
                'sort_order'  => 3,
                'is_active'   => true,
            ],


            [
                'title'       => 'Gallery Highlights',
                'component'   => 'sections.galleries',
                'model_type'  => 'App\Models\Article',
                'category_id' => $getCatId('gallery'),
                'limit'       => 9,
                'sort_order'  => 6,
                'is_active'   => true,
            ],

            [
                'title'       => 'Galla Sports',
                'component'   => 'sections.latest-in-gallery',
                'model_type'  => 'App\Models\Article',
                'category_id' => $getCatId('latest-in-gallery'),
                'limit'       => 9,
                'sort_order'  => 2,
                'is_active'   => true,
            ],
            // {{-- Optional: Add footer to sports page content stack here if needed --}}
        ];

        foreach ($sportsSections as $section) {
            $sportsPage->sections()->updateOrCreate(['title' => $section['title']], $section);
        }

        // ==========================================
        // 3. THE HADITHI PAGE
        // ==========================================
        $hadithiPage = Page::updateOrCreate(['slug' => 'hadithi'], ['title' => 'Hadithi']);

        $hadithiSections = [
            [
                'title'       => 'Hadithi Latest',
                'component'   => 'sections.hadithi-grid',
                'model_type'  => 'App\Models\Article',
                'category_id' => $getCatId('hadithi'),
                'limit'       => 10,
                'sort_order'  => 1,
                'is_active'   => true,
            ],
            [
                'title'       => 'International Sports',
                'component'   => 'sections.spoti-majuu-block',
                'model_type'  => 'App\Models\Article',
                'category_id' => $getCatId('spoti-majuu'),
                'limit'       => 9,
                'sort_order'  => 3,
                'is_active'   => true,
            ],
            [
                'title'       => 'Technology News',
                'component'   => 'sections.editorial-grid-block',
                'model_type'  => 'App\Models\Article',
                'category_id' => $getCatId('business'),
                'limit'       => 9,
                'sort_order'  => 4,
                'is_active'   => true,
            ],
            [
                'title'       => 'Video Highlights',
                'component'   => 'sections.videos',
                'model_type'  => 'App\Models\Article',
                'category_id' => $getCatId('videos'),
                'limit'       => 9,
                'sort_order'  => 5,
                'is_active'   => true,
            ],
            [
                'title'       => 'Gallery Highlights',
                'component'   => 'sections.galleries',
                'model_type'  => 'App\Models\Article',
                'category_id' => $getCatId('gallery'),
                'limit'       => 9,
                'sort_order'  => 6,
                'is_active'   => true,
            ],
        ];

        foreach ($hadithiSections as $section) {
            $hadithiPage->sections()->updateOrCreate(['title' => $section['title']], $section);
        }
    }
}
