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
            'title' => 'General Sports',
            'slug' => 'general-sports',
            'is_active' => true,
            'sort_order' => 1,
        ]);

        // Page::create([
        //     'title' => 'Entertainment',
        //     'slug' => 'entertainment',
        //     'is_active' => true,
        //     'sort_order' => 2,
        // ]);

    }
}
