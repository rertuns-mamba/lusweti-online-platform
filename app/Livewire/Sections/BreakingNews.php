<?php

namespace App\Livewire\Sections;

use App\Models\BreakingNews as BreakingNewsModel;
use Illuminate\Database\Eloquent\Collection;
use Livewire\Component;
use Livewire\Attributes\Computed;
use Livewire\Attributes\On;

class BreakingNews extends Component
{
    /**
     * Listen for the Pusher/Echo event dispatched by the Model.
     * Refresh the component seamlessly when news breaks.
     */
    #[On('echo:breaking-news,BreakingNewsUpdated')]
    public function refreshTicker(): void
    {
        unset($this->breakingItems);
    }

    #[Computed]
    public function breakingItems(): Collection
    {
        return BreakingNewsModel::active()
            ->orderByDesc('is_urgent')
            ->orderByDesc('priority')
            ->orderByDesc('created_at')
            ->take(6)
            ->get();
    }

    public function hasBreaking(): bool
    {
        return $this->breakingItems()->isNotEmpty();
    }

    

    public function render()
    {
        return view('livewire.sections.breaking-news');
    }
}




