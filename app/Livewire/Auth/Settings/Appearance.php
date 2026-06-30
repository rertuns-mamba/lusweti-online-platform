<?php 
declare(strict_types=1);
namespace App\Livewire\Auth\Settings;

use Livewire\Component;
use Illuminate\Support\Facades\Password;
use Livewire\Attributes\Layout;
use Illuminate\Contracts\View\View;

#[Layout('components.layouts.app')]


class Appearance extends Component
{
    /**
     * The chosen application theme option.
     */
    public string $appearance = 'system';

    /**
     * Initialize component state.
     */
    public function mount(): void
    {
        // Fetch current user preference or fallback to system configuration
        // $this->appearance = auth()->user()->settings->appearance ?? 'system';
    }

    /**
     * Component lifecycle hook triggering on updating properties.
     */
    public function updatedAppearance(string $value): void
    {
        $this->validateOnly('appearance');

        // Persist setting to storage engine
        // auth()->user()->settings()->update(['appearance' => $value]);

        // Dispatch browser event to instantly swap application HTML theme classes
        $this->dispatch('appearance-updated', appearance: $value);
    }

    /**
     * Validation rules configuration.
     *
     * @return array<string, array<int, string>>
     */
    protected function rules(): array
    {
        return [
            'appearance' => ['required', 'string', 'in:light,dark,system'],
        ];
    }

    public function render(): View
    {
        return view('livewire.auth.settings.appearance');
    }
}