<?php

namespace App\Livewire\Sections;

use App\Models\Page;
use App\Models\Article;
use App\Models\Category;
use Livewire\Component;
use Livewire\Attributes\Computed;

class SpotiKenya extends Component
{
    public ?Page $page = null;
    public array $settings = [];

    public function mount(?Page $page = null, array $settings = [])
    {
        // 1. Ensure page is set cleanly; if not provided, try resolving standard sports fallback
        $this->page = $page ?? Page::where('slug', 'sports')->first();
        $this->settings = $settings;
    }

    #[Computed]
    public function dynamicLayoutColumns(): array
    {
        // 2. Fetch the category ID from settings, or fall back dynamically to the 'Sports' category id
        $categoryId = $this->settings['category_id'] ?? null;

        if (!$categoryId) {
            $sportsCategory = Category::where('slug', 'sports')->first();
            $categoryId = $sportsCategory ? $sportsCategory->id : null;
        }

        // Guard clause: If no category structure exists in database at all, exit gracefully
        if (!$categoryId) {
            return [
                'hero'       => null,
                'thumbnails' => collect(),
                'textOnly'   => collect(),
            ];
        }        

        // Example query filtering for Category 2 (Sports) and sorting by latest
        $articles = Article::where('category_id', 2)
            ->where('is_visible', true)
            ->with(['media'])
            ->latest('published_at')
            ->get();

        // Backup safeguard check: if your custom local query scope returned nothing, try raw query bypass
        if ($articles->isEmpty()) {
            $articles = Article::where('category_id', $categoryId)
                ->where('is_visible', true)
                ->with(['media'])
                ->latest('published_at')
                ->take(8)
                ->get();
        }

        return [
            'hero'       => $articles->first(),
            'thumbnails' => $articles->slice(1, 3)->values(),
            'textOnly'   => $articles->slice(4, 4)->values(),
        ];
    }

    public function render()
    {
        return view('livewire.sections.spoti-kenya');
    }
}


