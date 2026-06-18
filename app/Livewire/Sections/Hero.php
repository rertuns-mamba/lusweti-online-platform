<?php

namespace App\Livewire\Sections;

use Livewire\Component;

use App\Models\Article;
use App\Models\Video;
use App\Models\Category;
use App\Models\PageSection;
use Livewire\Attributes\Computed;

class Hero extends Component
{
    public ?PageSection $section = null;

    public function mount(?PageSection $section = null)
    {
        $this->section = $section;
    }

    #[Computed]
    public function category()
    {
        // 1. First priority: The explicit category assigned to this specific PageSection
        if ($this->section?->category_id) {
            return Category::find($this->section->category_id);
        }

        // 2. Second priority: Dynamic fallback via URL routing slug
        $slug = request()->route('slug');
        if ($slug) {
            return Category::where('slug', $slug)->first();
        }

        return null;
    }


    public function render()
    {
        $category = $this->category;

        // 1. Grid Content: Articles tightly bound to this section's category
        $mainArticles = Article::with(['media', 'category'])
            ->where('is_active', true)
            ->when($category, function ($query) use ($category) {
                return $query->where('category_id', $category->id);
            })
            ->orderBy('published_at', 'desc')
            ->take(7)
            ->get();

        // 2. Sidebar: Latest Images strictly from this section's category
        $imageItems = Article::where('is_active', true)
            ->when($category, function ($query) use ($category) {
                return $query->where('category_id', $category->id);
            })
            ->where(function ($query) {
                $query->whereNotNull('featured_image_thumb_url')
                    ->orHas('media');
            })
            ->orderBy('published_at', 'desc')
            ->take(3)
            ->get();

        // 3. Sidebar: External RSS Links strictly from this section's category
        $externalItems = Article::where('is_active', true)
            ->when($category, function ($query) use ($category) {
                return $query->where('category_id', $category->id);
            })
            ->whereNotNull('external_url')
            ->orderBy('published_at', 'desc')
            ->take(3)
            ->get();

        // 4. Sidebar: Related Stories from the same category (excluding the hero item)
        $relatedArticles = Article::where('is_active', true)
            ->when($category, function ($query) use ($category) {
                return $query->where('category_id', $category->id);
            })
            ->where('id', '!=', $mainArticles->first()?->id)
            ->orderBy('published_at', 'desc')
            ->take(3)
            ->get();

        // 5. Sidebar: Video handling (with Eager Loading & Global Fallback)
        $activeVideo = Article::with(['category', 'media']) // Eager load relationships for the blade file
            ->where('is_active', true)
            ->when($category, function ($query) use ($category) {
                return $query->where('category_id', $category->id);
            })
            ->where(function ($query) {
                // Condition A: External YouTube link
                $query->where(function ($sub) {
                    $sub->where('is_youtube', true)
                        ->whereNotNull('video_url');
                })
                    // Condition B: Local Spatie video collection
                    ->orWhereHas('media', function ($mediaQuery) {
                        $mediaQuery->where('collection_name', 'videos');
                    });
            })
            ->orderBy('published_at', 'desc')
            ->first();

        // FALLBACK LOGIC: If no video exists in this section's specific category,
        // grab the latest active video available site-wide so the widget doesn't disappear.
        if (!$activeVideo) {
            $activeVideo = Article::with(['category', 'media'])
                ->where('is_active', true)
                ->where(function ($query) {
                    $query->where(function ($sub) {
                        $sub->where('is_youtube', true)
                            ->whereNotNull('video_url');
                    })
                        ->orWhereHas('media', function ($mediaQuery) {
                            $mediaQuery->where('collection_name', 'videos');
                        });
                })
                ->orderBy('published_at', 'desc')
                ->first();
        }

        return view('livewire.sections.hero', [
            'featuredLargeLeft' => $mainArticles->take(1),
            'textTeasers'       => $mainArticles->slice(1, 3),
            'rightThumbnails'   => $mainArticles->slice(4, 3),
            'activeVideo'       => $activeVideo,
            'imageItems'        => $imageItems,
            'externalItems'     => $externalItems,
            'relatedArticles'   => $relatedArticles
        ]);
    }

    // public function render()
    // {
    //     $category = $this->category;

    //     // 1. Grid Content: Articles tightly bound to this section's category
    //     $mainArticles = Article::with(['media', 'category'])
    //         ->where('is_active', true)
    //         ->when($category, function ($query) use ($category) {
    //             return $query->where('category_id', $category->id);
    //         })
    //         ->orderBy('published_at', 'desc')
    //         ->take(7)
    //         ->get();

    //     // 2. Sidebar: Latest Images strictly from this section's category
    //     $imageItems = Article::where('is_active', true)
    //         ->when($category, function ($query) use ($category) {
    //             return $query->where('category_id', $category->id);
    //         })
    //         ->where(function ($query) {
    //             $query->whereNotNull('featured_image_thumb_url')
    //                 ->orHas('media');
    //         })
    //         ->orderBy('published_at', 'desc')
    //         ->take(3)
    //         ->get();

    //     // 3. Sidebar: External RSS Links strictly from this section's category
    //     $externalItems = Article::where('is_active', true)
    //         ->when($category, function ($query) use ($category) {
    //             return $query->where('category_id', $category->id);
    //         })
    //         ->whereNotNull('external_url')
    //         ->orderBy('published_at', 'desc')
    //         ->take(3)
    //         ->get();

    //     // 4. Sidebar: Related Stories from the same category (excluding the hero item)
    //     $relatedArticles = Article::where('is_active', true)
    //         ->when($category, function ($query) use ($category) {
    //             return $query->where('category_id', $category->id);
    //         })
    //         ->where('id', '!=', $mainArticles->first()?->id)
    //         ->orderBy('published_at', 'desc')
    //         ->take(3)
    //         ->get();

    //     // 5. Sidebar: Video handling (Now querying the Article model)
    //     // We look for an article in this category that either is a YouTube link, 
    //     // or has a file in the 'videos' Spatie media collection.
    //     // 5. Sidebar: Video handling (Hybrid Spatie + Database query)
    //     $activeVideo = Article::where('is_active', true)
    //         ->when($category, function ($query) use ($category) {
    //             return $query->where('category_id', $category->id);
    //         })
    //         ->where(function ($query) {
    //             // Condition A: It is an external YouTube link
    //             $query->where(function ($sub) {
    //                 $sub->where('is_youtube', true)
    //                     ->whereNotNull('video_url');
    //             })
    //                 // Condition B: OR it has a local Spatie video attached
    //                 ->orWhereHas('media', function ($mediaQuery) {
    //                     $mediaQuery->where('collection_name', 'videos');
    //                 });
    //         })
    //         ->orderBy('published_at', 'desc')
    //         ->first();

    //     return view('livewire.sections.hero', [
    //         'featuredLargeLeft' => $mainArticles->take(1),
    //         'textTeasers'       => $mainArticles->slice(1, 3),
    //         'rightThumbnails'   => $mainArticles->slice(4, 3),
    //         'activeVideo'       => $activeVideo,
    //         'imageItems'        => $imageItems,
    //         'externalItems'     => $externalItems,
    //         'relatedArticles'   => $relatedArticles
    //     ]);
    // }

}
