<?php

namespace App\Livewire\Sections;

use App\Models\Article;
use App\Models\Category;
use App\Models\PageSection;
use Livewire\Attributes\Computed;
use Livewire\Component;

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
        return Category::find($this->section->category_id);
    }

    public function render()
    {
        $articles = collect();

        if ($this->section->category_id) {
            $articles = Article::with(['page', 'category', 'media'])
                ->where('category_id', $this->section->category_id)
                ->where('is_visible', true)
                ->latest('published_at')
                ->take(8)
                ->get();
        }

        return view('livewire.sections.latest-in-gallery', [
            'articles' => $articles,
            'count' => 5,

            // Safe fallback extractions for all responsive radii
            'mobileRadius' => $this->settings['mobileRadius'] ?? 0,
            'tabletRadius' => $this->settings['tabletRadius'] ?? 0,
            'desktopRadius' => $this->settings['desktopRadius'] ?? 0,
        ]);
    }
}
