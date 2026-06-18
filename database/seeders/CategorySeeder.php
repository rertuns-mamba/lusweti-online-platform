<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            ['name' => 'News', 'sort_order' => 1],
            ['name' => 'Sports', 'sort_order' => 2],
            ['name' => 'Business', 'sort_order' => 3],
            ['name' => 'Entertainment', 'sort_order' => 4],
            ['name' => 'Videos', 'sort_order' => 5],
            ['name' => 'Gallery', 'sort_order' => 6],
            ['name' => 'Hadithi', 'sort_order' => 7],
            ['name' => 'Hero', 'sort_order' => 8],
            ['name' => 'Spoti Majuu', 'sort_order' => 9],
            ['name' => 'Spoti Kenya', 'sort_order' => 10],
            ['name' => 'Burudani', 'sort_order' => 11],
            ['name' => 'Magazine', 'sort_order' => 12],
            ['name' => 'Footer', 'sort_order' => 13],
            ['name' => 'Latest In Gallery', 'sort_order' => 14],
            
        ];

        foreach ($categories as $category) {
            Category::firstOrCreate(
                ['name' => $category['name']],
                [
                    'slug' => Str::slug($category['name']),
                    'sort_order' => $category['sort_order'],
                    'is_active' => true,
                    'description' => "Global coverage of {$category['name']} updates.",
                ]
            );
        }
    }
}