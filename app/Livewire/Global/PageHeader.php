<?php

namespace App\Livewire\Global;

use App\Models\SiteSetting;
use Illuminate\Support\Carbon;
use Livewire\Component; // <-- Import Carbon

class PageHeader extends Component
{
    public string $tagline;

    public array $formattedDate;

    public function mount(): void
    {
        $settings = SiteSetting::current();

        $this->tagline = $settings->tagline ?? 'Your Trusted News Source';

        // Failsafe: Force parse it into Carbon, ensuring format() always exists
        $displayDate = Carbon::parse($settings->display_date ?? now());

        $this->formattedDate = [
            'iso' => $displayDate->format('Y-m-d'),
            'human' => $displayDate->format('l, j F Y'),
        ];
    }

    public function render()
    {
        return view('livewire.global.page-header');
    }
}
