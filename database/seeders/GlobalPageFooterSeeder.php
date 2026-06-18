<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\GlobalPageFooter as GlobalFooter;

class GlobalPageFooterSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        GlobalFooter::updateOrCreate(['id' => 1], [
            'brand_name' => 'Lusweti Online',
            'brand_description' => 'A premier publication focusing on deep-dive journalism, local news, and community stories.',
            'copyright_text' => 'Lusweti Online Center',
            'meta_links' => [
                ['title' => 'Privacy Policy', 'url' => '/privacy', 'open_in_new_tab' => false],
                ['title' => 'Terms of Service', 'url' => '/terms', 'open_in_new_tab' => false],
            ]
        ]);
    }
}
