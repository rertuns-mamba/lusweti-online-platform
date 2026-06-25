<?php

namespace App\Livewire\Sections;

use Livewire\Component;

use App\Models\Article;
use App\Models\PageSection;

class EditorialGridBlock extends Component
{
    public PageSection $section;
    public $category;
    
    public $featuredItem;
    public $standardItems = [];

    public function mount(PageSection $section)
    {
        $this->section = $section;
        $this->category = $this->section->category;

        // Elevated safety threshold for high-volume scrolling news feeds
        $limit = $this->section->limit ?? 5;

        $items = $this->section->getQuery()
            ->with(['media', 'category']) // Eager load category to avoid repetitive single SQL checks
            ->limit($limit)
            ->get();

        if ($items->isNotEmpty()) {
            $this->featuredItem = $items->shift();
            $this->standardItems = $items;
        }
    }

    public function render()
    {
        return view('livewire.sections.editorial-grid-block');
    }
}
