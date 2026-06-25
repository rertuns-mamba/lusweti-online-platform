<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class PortalsSeeder extends Seeder
{
    public $withinTransaction = false;

    public function run(): void
    {
        // Ensure the Video News and Gallery News categories exist.
        // Note: These are created by VideoGridSeeder and GalleryGridSeeder which run before this seeder in DatabaseSeeder.
        // This ensures they're present for the portal pages to use.
        
        Category::updateOrCreate(
            ['slug' => 'video-news'],
            [
                'name' => 'Video News',
                'title' => 'Video News',
                'is_active' => true,
            ]
        );

        Category::updateOrCreate(
            ['slug' => 'gallery-news'],
            [
                'name' => 'Gallery News',
                'title' => 'Gallery News',
                'is_active' => true,
            ]
        );
    }
}
