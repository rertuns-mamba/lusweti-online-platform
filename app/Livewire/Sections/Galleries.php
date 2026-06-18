<?php 

namespace App\Livewire\Sections;

use App\Models\PageSection;
use App\Models\Page;
use App\Models\Article;
use App\Models\Category;
use Livewire\Component;
use Livewire\Attributes\Computed;

class Galleries extends Component
{
    public PageSection $section;
    
    // Make the property nullable to handle missing data gracefully
    public ?Page $page = null; 
    
    public array $settings = [];

    public function mount(PageSection $section, array $settings = [])
    {
        $this->section = $section;
        $this->page = $section->page; // Will safely assign null if unlinked
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
        // Querying Article model filtered by your Gallery category
        return Article::query()
            ->where('category_id', $this->section->category_id)
            ->where('is_visible', true)
            ->with(['media', 'category']) // Eager-load media and category data to avoid N+1 queries
            ->latest('published_at')
            ->take($this->settings['limit'] ?? 4)
            ->get();
    }

    public function render()
    {
        return view('livewire.sections.galleries');
    }
}