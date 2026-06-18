<?php

namespace Tests\Feature;

use App\Http\Controllers\SearchController;
use App\Models\Article;
use App\Models\Category;
use App\Models\Video;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\Request;
use Tests\TestCase;

class SearchTest extends TestCase
{
    use RefreshDatabase;

    public function test_search_results_are_built_without_missing_show_routes(): void
    {
        Article::create([
            'title' => 'Hero Article',
            'slug' => 'hero-article',
            'content' => 'A searchable article.',
        ]);

        $category = Category::create([
            'name' => 'Videos',
            'slug' => 'videos',
        ]);

        Video::create([
            'category_id' => $category->id,
            'title' => 'Hero Video',
            'slug' => 'hero-video',
            'youtube_id' => 'abc123',
            'published_at' => now(),
        ]);

        $request = Request::create('/search', 'GET', ['query' => 'Hero']);

        $response = (new SearchController())->index($request);
        $results = $response->getData()['results'];

        $this->assertSame('search.results', $response->name());
        $this->assertCount(2, $results);
        $this->assertSame('Article', $results->first()['type']);
        $this->assertNull($results->first()['url']);
        $this->assertSame('https://www.youtube.com/watch?v=abc123', $results->last()['url']);
    }
}
