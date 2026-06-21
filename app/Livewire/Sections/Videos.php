<?php

namespace App\Livewire\Sections;

use App\Models\Article;
use App\Models\Category;
use App\Models\Page;
use App\Models\PageSection;
use Livewire\Attributes\Computed;
use Livewire\Component;

class Videos extends Component
{
    public PageSection $section;

    // 1. Make the property nullable so it can safely accept null
    public ?Page $page = null;

    public array $settings = [];

    public function mount(PageSection $section, array $settings = [])
    {
        $this->section = $section;

        // 2. Safely assign the relationship (it will be null if missing)
        $this->page = $section->page;

        $this->settings = $settings;
    }

    #[Computed]
    public function category()
    {
        return Category::find($this->section->category_id);
    }

    #[Computed]
    public function collectionItems()
    {
        return Article::query()
            ->where('category_id', $this->section->category_id)
            ->where('is_visible', true)
            ->with(['media']) // Eager-loading ensures ultra-fast grid rendering
            ->latest('published_at')
            ->take($this->settings['limit'] ?? 4)
            ->get();
    }

    public function render()
    {
        return view('livewire.sections.videos');
    }
}
