<?php

namespace App\Livewire\Frontend;

use App\Models\Page;
use Livewire\Component;

class PageRenderer extends Component
{
    public Page $page;

    public function mount(Page $page)
    {
        $this->page = $page;
    }

    public function render()
    {
        return view('livewire.frontend.page-renderer');
    }
}