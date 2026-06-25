<?php

namespace Database\Seeders;

use App\Models\BreakingNews;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;

class BreakingNewsSeeder extends Seeder
{
    public $withinTransaction = false;

    public function run(): void
    {
        $newsItems = [
            [
                'data' => [
                    'title' => 'Global markets rally as central banks signal interest rate cuts',
                    'url' => 'https://example.com/markets-rally',
                    'is_active' => true,
                    'is_live' => false,
                    'priority' => 5,
                ],
                'image' => 'markets.jpg' // Optional: add image filename here
            ],
            // ... add more items
        ];

        foreach ($newsItems as $item) {
            $breakingNews = BreakingNews::create($item['data']);

            // Attach image only if provided
            if (!empty($item['image'])) {
                $this->attachMedia($breakingNews, $item['image']);
            }
        }
    }

    private function attachMedia(BreakingNews $model, string $filename): void
    {
        $path = public_path('seeds/' . $filename);
        if (file_exists($path)) {
            $model->addMedia($path)->preservingOriginal()->toMediaCollection('featured_image');
        }
    }
}