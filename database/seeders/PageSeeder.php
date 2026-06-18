<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Page;

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
            'sort_order' => 1,
        ]);

        Page::create([
            'title' => 'Entertainment',
            'slug' => 'entertainment',
            'is_active' => true,
            'sort_order' => 2,
        ]);
    }
}
