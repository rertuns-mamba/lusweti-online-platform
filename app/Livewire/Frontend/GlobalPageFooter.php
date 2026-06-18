<?php

namespace App\Livewire\Frontend;

use App\Models\Page;
use Livewire\Component;

class GlobalPageFooter extends Component
{
    // Changed property from $footerCategories to match navbar design
    public array $pages = []; 
    public int $currentYear;
    public string $brandName;
    public string $brandDescription;

    public function mount(): void
    {
        // 1. Pull dynamic page structures directly matching the Navbar architecture
        $this->pages = Page::query()
            ->select(['id', 'title', 'slug'])
            ->where('is_visible_in_nav', true)
            ->where('status', 'published')
            ->orderBy('sort_order')
            ->get()
            ->toArray();

        // 2. Static elements (Zero DB queries)
        $this->currentYear = now()->year;
        $this->brandName = config('app.name', 'Lusweti');
        $this->brandDescription = 'Your trusted source for news, dynamic content updates, and editorial articles.';
    }

    public function render()
    {
        return view('livewire.frontend.global-page-footer');
    }
}