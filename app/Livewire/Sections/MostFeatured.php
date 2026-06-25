<?php

namespace App\Livewire\Sections;

use Livewire\Component;
use App\Models\Article;
use App\Models\Video;
use App\Models\Category;
use App\Models\PageSection;
use Livewire\Attributes\Computed;

class MostFeatured extends Component
{
    public ?PageSection $section = null;

    public function mount(?PageSection $section = null)
    {
        // Accept page section context if passed from the layout controller
        $this->section = $section;
    }

    #[Computed]
    public function category()
    {
        // 1. Try resolving via assigned section instance
        if ($this->section?->category_id) {
            return Category::find($this->section->category_id);
        }

        // 2. Fallback to matching via current route slug parameter (e.g., /sports)
        $slug = request()->route('slug');
        if ($slug) {
            return Category::where('slug', $slug)->first();
        }

        return null;
    }

    public function render()
    {
        $category = $this->category;

        // 1. Fetch recent active articles (scoped contextually if category exists)
        $articles = Article::with(['media', 'category'])
            ->where('is_active', true)
            ->when($category, function ($query) use ($category) {
                return $query->where('category_id', $category->id);
            })
            ->orderBy('published_at', 'desc')
            ->take(15)
            ->get()
            ->map(function ($item) {
                $item->type = filled($item->external_url) ? 'external' : 'article';
                return $item;
            });

        // 2. Fetch recent active videos
        $videos = Video::with(['media'])
            ->where('is_active', true)
            // Optional: Uncomment below if your videos table contains a category_id column
            // ->when($category, function ($query) use ($category) {
            //     return $query->where('category_id', $category->id);
            // })
            ->orderBy('created_at', 'desc')
            ->take(15)
            ->get()
            ->map(function ($item) {
                $item->type = 'video';
                $item->published_at = $item->created_at; 
                return $item;
            });

        // 3. Merge, sort, and slice to create the uniform slider dataset
        $feedItems = $articles->concat($videos)
            ->sortByDesc('published_at')
            ->take(16)
            ->values();

        return view('livewire.sections.most-featured', [
            'feedItems' => $feedItems
        ]);
    }
}
