<?php

declare(strict_types=1);

namespace App\Livewire\Navigation;

use App\Models\Stream;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class WatchLiveButton extends Component
{
    public function render(): View
    {
        $isAdmin = Auth::check() && Auth::user()->hasRole('Super Admin');

        // Check if an active stream exists
        $isStreamLive = Stream::where('is_live', true)->exists();

        \Log::info('WatchLiveButton - isAdmin: ' . ($isAdmin ? 'true' : 'false') . ', isStreamLive: ' . ($isStreamLive ? 'true' : 'false'));

        return view('livewire.navigation.watch-live-button', [
            'isAdmin' => $isAdmin,
            'isStreamLive' => $isStreamLive,
        ]);
    }
}