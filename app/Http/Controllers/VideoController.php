<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Video;

class VideoController extends Controller
{
    public function index()
    {
        $videos = Video::where('is_visible', true)
            ->where('published_at', '<=', now())
            ->with(['category', 'media'])
            ->orderByDesc('published_at')
            ->orderByDesc('id')
            ->paginate(12);

        return view('videos.index', compact('videos'));
    }

    public function show($slug)
    {
        $video = Video::where('slug', $slug)
            ->where('is_visible', true)
            ->where('published_at', '<=', now())
            ->with(['category', 'media'])
            ->firstOrFail();

        // Load related articles by category
        $relatedArticles = collect();
        if ($video->category) {
            $relatedArticles = Article::where('category_id', $video->category_id)
                ->where('is_visible', true)
                ->where('published_at', '<=', now())
                ->with(['category', 'page', 'media'])
                ->orderByDesc('published_at')
                ->orderByDesc('id')
                ->take(6)
                ->get();
        }

        return view('videos.show', compact('video', 'relatedArticles'));
    }
}
