<?php

namespace Database\Seeders;

use App\Models\Page;
use Illuminate\Database\Seeder;

class PageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Page::create([
            'title' => 'Sports',
            'slug' => 'sports',
            'is_active' => true,
            'sort_order' => 3,
        ]);

        Page::create([
            'title' => 'Entertainment',
            'slug' => 'entertainment',
            'is_active' => true,
            'sort_order' => 2,
        ]);

    }
}
