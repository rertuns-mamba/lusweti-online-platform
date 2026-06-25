<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        // 1. Flattened array: sort_order is now determined automatically by the index
        $categories = [
            'Sports News', // Note: Fixed the 'Geral' typo
            'Business',
            'Videos',
            'Gallery',
            'Hadithi',
            'Hero',
            'Spoti Majuu',
            'Spoti Kenya',
            'Burudani',
            'Most Featured',
            'Footer',
            'Latest In Gallery',
        ];

        foreach ($categories as $index => $name) {
            // 2. Used updateOrCreate and matched by slug
            Category::updateOrCreate(
                ['slug' => Str::slug($name)], 
                [
                    'name' => $name,
                    'sort_order' => $index + 1, // Maps index 0 to sort_order 1, etc.
                    'is_active' => true,
                    'description' => "Global coverage of {$name} updates.",
                ]
            );
        }
    }
}