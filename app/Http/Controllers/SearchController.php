<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Video;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function index(Request $request)
    {
        $term = $request->input('query');
        
        // Return empty results if search term is empty
        if (!$term) {
            return view('search.results', ['results' => collect(), 'query' => '']);
        }

        // Example searching Articles and Videos
        $articles = Article::where('title', 'LIKE', "%{$term}%")->get()->map(fn($item) => [
            'type' => 'Article',
            'title' => $item->title,
            'url' => route('articles.show', $item->id)
        ]);

        $videos = Video::where('title', 'LIKE', "%{$term}%")->get()->map(fn($item) => [
            'type' => 'Video',
            'title' => $item->title,
            'url' => route('videos.show', $item->id)
        ]);

        return view('search.results', [
            'results' => $articles->concat($videos),
            'query' => $term
        ]);
    }
}