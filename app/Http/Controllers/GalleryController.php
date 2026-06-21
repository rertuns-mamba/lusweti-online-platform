<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Gallery;

class GalleryController extends Controller
{
    public function index()
    {
        $galleries = Gallery::where('is_visible', true)
            ->where('published_at', '<=', now())
            ->with(['category', 'media'])
            ->orderByDesc('published_at')
            ->orderByDesc('id')
            ->paginate(12);

        return view('galleries.index', compact('galleries'));
    }

    public function show($slug)
    {
        $gallery = Gallery::where('slug', $slug)
            ->where('is_visible', true)
            ->where('published_at', '<=', now())
            ->with(['category', 'media'])
            ->firstOrFail();

        // Load related articles by category
        $relatedArticles = collect();
        if ($gallery->category) {
            $relatedArticles = Article::where('category_id', $gallery->category_id)
                ->where('is_visible', true)
                ->where('published_at', '<=', now())
                ->with(['category', 'page', 'media'])
                ->orderByDesc('published_at')
                ->orderByDesc('id')
                ->take(6)
                ->get();
        }

        return view('galleries.show', compact('gallery', 'relatedArticles'));
    }
}
