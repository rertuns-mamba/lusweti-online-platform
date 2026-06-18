<?php 

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Page;
use App\Models\Category;
use App\Models\Video;
use Illuminate\Support\Str;

class VideoGridSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Create the Page (Determines Layout, URLs, and Navbar presence)
        $page = Page::updateOrCreate(
            ['slug' => 'videos'],
            [
                'title' => 'Video Portal',
                'bg_color' => '#2563eb', // A sharp blue indicator for Video content
                'text_color' => '#ffffff',
                'show_in_nav' => true,
                'nav_order' => 2,
            ]
        );

        // 2. Create the Category (Determines Data Organization)
        $category = Category::updateOrCreate(
            ['slug' => 'featured-broadcasts'],
            [
                'title' => 'Featured Broadcasts',
                'is_active' => true,
            ]
        );

        // 3. Attach the Video Grid Section to the Page
        $page->sections()->updateOrCreate(
            ['component' => 'sections.videos'], 
            [
                'sort_order' => 1,
                'is_visible' => true,
                'settings' => [
                    'category_id' => $category->id,
                    'limit' => 4,
                    'subtitle' => 'Watch the latest field reports and highlights'
                ]
            ]
        );

        // 4. Seed YouTube Videos for the grid with more variety
        $youtubeIds = [
            'jNQXAC9IVRw', // Me at the zoo
            'dQw4w9WgXcQ', // Rick Astley - Never Gonna Give You Up
            'tPEE9ZwTmy0', // PSY - Gangnam Style
            '9bZkp7q19f0', // PSY - Gentleman
            'kJQP7kiw5Fk', // Luis Fonsi - Despacito
            'RgKAFK5djSk', // Wiz Khalifa - See You Again
            'JGwWNGJdvx8', // Ed Sheeran - Shape of You
            'OPf0YbXqDm0', // Mark Ronson - Uptown Funk
            'CevxZvSJLk8', // Katy Perry - Roar
            'fRh_vgS2dFE', // Justin Bieber - Sorry
            'hT_nvWreIhg', // Count on Me - Bruno Mars
            '09R8_2nJtjg', // Sugar - Maroon 5
            'pRpeEdMmmQ0', // Shake It Off - Taylor Swift
            'YQHsXMglC9A', // Hello - Adele
            'PT2_F-1esPk', // Uptown Funk - Mark Ronson
        ];

        foreach ($youtubeIds as $index => $ytId) {
            Video::updateOrCreate(
                ['youtube_id' => $ytId],
                [
                    'category_id' => $category->id,
                    'title' => "Sports Broadcast Report - Segment " . ($index + 1),
                    'slug' => "broadcast-report-{$index}",
                    'is_youtube' => true,
                    'is_visible' => true,
                    'published_at' => now()->subDays($index),
                ]
            );
        }

        $this->command->info('Video Grid Architecture Seeded Successfully!');
    }
}