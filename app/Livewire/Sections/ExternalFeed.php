<?php 

namespace App\Livewire\Sections;

use App\Models\ExternalArticle;
use App\Models\Category;
use App\Models\PageSection;
use Livewire\Component;

class ExternalFeed extends Component
{
    public PageSection $section;
    public $category;
    public $collectionItems;

    public function mount()
    {
        $slug = $this->section->settings['category_slug'] ?? null;
        $this->category = Category::where('slug', $slug)->first();

        $this->collectionItems = $this->category 
            ? ExternalArticle::where('category_id', $this->category->id)
                ->where('is_visible', true)
                ->latest('published_at')
                ->limit(8)
                ->get() 
            : collect();
    }

    public function render()
    {
        return view('livewire.sections.external-feed');
    }
}