<?php

namespace App\Http\Controllers;

use App\Models\Article;

class ArticleController extends Controller
{
    public function show(string $pageSlug, string $articleSlug)
    {
        $article = Article::where('slug', $articleSlug)
            ->where('is_visible', true)
            ->with(['category', 'media', 'page'])
            ->firstOrFail();

        $relatedArticles = Article::where('category_id', $article->category_id)
            ->where('id', '!=', $article->id)
            ->where('is_visible', true)
            ->latest('published_at')
            ->take(6)
            ->get();

        return view('articles.show', compact('article', 'relatedArticles'));
    }
}
