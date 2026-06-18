<?php

namespace App\Livewire\Sections;

use App\Models\PageSection;
use App\Models\Article;
use App\Models\Category;
use Livewire\Component;
use Livewire\Attributes\Computed;

class LatestInGallery extends Component
{
    public PageSection $section;
    public array $settings = [];

    public function mount(PageSection $section, array $settings = [])
    {
        $this->section = $section;
        $this->settings = $settings;
    }

    #[Computed]
    public function category()
    {
        // Resolves $this->category for the Blade view safely
        return Category::find($this->section->category_id);
    }

    public function render()
    {
        $articles = collect();

        if ($this->section->category_id) {
            $articles = Article::with(['page', 'category', 'media'])
                ->where('category_id', $this->section->category_id)
                ->where('is_visible', true) // Added safety check for published items
                ->latest('published_at')
                ->take(8) // Keeps the ideal geometric octagon shape
                ->get();
        }

        return view('livewire.sections.latest-in-gallery', [
            'articles' => $articles
        ]);
    }
}