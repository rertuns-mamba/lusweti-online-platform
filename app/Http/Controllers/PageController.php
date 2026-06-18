<?php

namespace App\Http\Controllers;

use App\Models\Page;
use Illuminate\Http\Request;

class PageController extends Controller
{
    /**
     * Display the specified CMS page by its slug.
     */
    public function show(string $slug)
    {
        // 1. Fetch the page with its active, ordered sections eager-loaded
        $page = Page::with(['sections' => function ($query) {
                $query->where('is_active', true)->orderBy('sort_order');
            }])
            ->where('slug', $slug)
            ->where('is_active', true)
            ->firstOrFail(); // Throws a 404 if the page doesn't exist or is inactive

        // 2. Return your master page view layout
        return view('pages.show', compact('page'));
    }
}