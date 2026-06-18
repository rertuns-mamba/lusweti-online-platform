<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Article;
use App\Models\Category;
use App\Jobs\ScrapeExternalArticleCover; // 1. Import your queue job
use Illuminate\Support\Facades\Http;
use Carbon\Carbon;

class FetchExternalNews extends Command
{
    protected $signature = 'news:fetch-external';
    protected $description = 'Fetch external RSS feeds and save them as articles';

    public function handle()
    {
        $response = Http::get('https://newsapi.org/v2/top-headlines?country=ke&apiKey=YOUR_API_KEY');
        
        if ($response->successful()) {
            $articles = $response->json()['articles'];
            $category = Category::where('slug', 'business')->first();

            foreach ($articles as $feedItem) {
                // 2. Capture the persisted model instance into a variable ($article)
                $article = Article::updateOrCreate(
                    ['external_url' => $feedItem['url']], 
                    [
                        'title' => $feedItem['title'],
                        'category_id' => $category->id ?? null,
                        'layout_type' => 'teaser-image-none', 
                        'featured_image_thumb_url' => $feedItem['urlToImage'], // Fallback thumbnail
                        'published_at' => Carbon::parse($feedItem['publishedAt']),
                        'is_active' => true,
                    ]
                );

                // 3. Connection Point: Hand off the heavy lifting to the background queue
                // 'wasRecentlyCreated' checks if it's a completely new database record
                if ($article->wasRecentlyCreated || !$article->hasMedia('featured_image')) {
                    ScrapeExternalArticleCover::dispatch($article->id);
                }
            }
            
            $this->info('External news fetched and image scraping jobs dispatched successfully!');
        }
    }
}