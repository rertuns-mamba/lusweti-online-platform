<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Video;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function index(Request $request): View
    {
        $term = trim((string) $request->input('query', ''));

        // Return empty results if search term is empty
        if ($term === '') {
            return view('search.results', ['results' => collect(), 'query' => '']);
        }

        // Example searching Articles and Videos
        $articles = Article::where('title', 'LIKE', "%{$term}%")->get()->map(fn (Article $item): array => [
            'id' => $item->id,
            'type' => 'Article',
            'title' => $item->title,
            'url' => $item->external_url,
        ]);

        $videos = Video::where('title', 'LIKE', "%{$term}%")->get()->map(fn (Video $item): array => [
            'id' => $item->id,
            'type' => 'Video',
            'title' => $item->title,
            'url' => $item->video_url ?: ($item->youtube_id ? "https://www.youtube.com/watch?v={$item->youtube_id}" : null),
        ]);

        return view('search.results', [
            'results' => $articles->concat($videos),
            'query' => $term,
        ]);
    }
}
