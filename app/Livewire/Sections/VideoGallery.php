<?php

namespace App\Livewire\Sections;

use App\Models\Article;
use App\Models\Category;
use App\Models\Video;
use App\Models\PageSection;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Contracts\View\View;
use Livewire\Attributes\Layout;
use Livewire\Attributes\On;

#[Layout('components.layouts.app', only: ['render'])]

class VideoGallery extends Component
{

    public function render()
    {
        // the media eager loading in the scope prevents N+1
        $videos = Video::query()->publishedFeed($this->settings['category_id'] ?? 1)->take(4)->get();

        return view('livewire.sections.video-gallery', compact('videos'));
    }
}
