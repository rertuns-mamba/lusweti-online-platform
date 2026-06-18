<?php

namespace App\Livewire\Sections;

use App\Models\Article; // Changed from Hadithi
use App\Models\Category;
use App\Models\PageSection;
use Livewire\Component;

class HadithiGrid extends Component
{
    public PageSection $section;
    public $category;
    public $columnLayouts;

    public function mount()
    {
        $this->category = Category::find($this->section->category_id);

        // Optimized Query: Query the Article model using the section's category
        $articles = $this->category 
            ? Article::where('category_id', $this->category->id)
                ->where('is_visible', true)
                ->with(['media']) // Eager load Spatie Media
                ->latest('published_at')
                ->limit(9)
                ->get()
            : collect();

        $this->columnLayouts = [
            'featured'   => $articles->first(),
            'thumbnails' => $articles->slice(1, 4),
            'textOnly'   => $articles->slice(5, 4),
        ];
    }

    public function render()
    {
        return view('livewire.sections.hadithi-grid');
    }
}