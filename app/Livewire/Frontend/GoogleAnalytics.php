<?php

namespace App\Livewire\Frontend;

use App\Models\Video;
use Illuminate\Contracts\View\View;
use Livewire\Attributes\On;
use Livewire\Component;

class GoogleAnalytics extends Component
{
    /**
     * Engineer-class realtime listener for video updates.
     * Listens to video broadcasts and re-renders when new videos are published.
     * Broadcasts on 'videos' channel with 'feed.updated' event name.
     */
    public function render(): View
    {
        return view('livewire.frontend.google-analytics');
    }
}
