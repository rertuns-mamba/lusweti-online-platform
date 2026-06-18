<?php

namespace App\Livewire\Sections;
use Livewire\Component;
use App\Models\PageSection;
use App\Models\Article;
use App\Models\Category;

class SpotiMajuuBlock extends Component
{
    public PageSection $section;
    public $category;
    public array $columnLayouts = [
        'featured'   => null,
        'thumbnails' => [],
        'textOnly'   => []
    ];

    public function mount(PageSection $section)
    {
        $this->section = $section;
        
        // 1. Resolve Category safely with a slug fallback if relation isn't direct
        $this->category = $this->section->category ?? Category::where('slug', 'majuu')->first();

        // 2. Fetch the collection dynamically using the Section's query engine
        $limit = $this->section->limit ?? 9;
        
        // Try getting articles using the system's dynamic query blueprint
        $items = collect();
        if ($this->section && method_exists($this->section, 'getQuery')) {
            $items = $this->section->getQuery()
                ->where('is_visible', true)
                ->with(['media']) // Eager load Spatie media to stop N+1 queries
                ->latest('published_at')
                ->limit($limit)
                ->get();
        }

        // Defensive Fallback: If query returned nothing, fall back to direct category matching
        if ($items->isEmpty() && $this->category) {
            $items = Article::where('category_id', $this->category->id)
                ->where('is_visible', true)
                ->with(['media'])
                ->latest('published_at')
                ->take($limit)
                ->get();
        }

        // 3. Slice and allocate data precisely for the BBC 12-Column Grid
        if ($items->isNotEmpty()) {
            // Need copies of items to prevent slicing references messing with arrays
            $workingItems = clone $items;

            $this->columnLayouts['featured'] = $workingItems->shift(); // 1 Featured Item
            $this->columnLayouts['thumbnails'] = $workingItems->splice(0, 4)->values()->all(); // Next 4 Items
            $this->columnLayouts['textOnly'] = $workingItems->values()->all(); // Remaining Items
        }
    }



    public function render()
    {
        return view('livewire.sections.spoti-majuu-block');
    }
}






