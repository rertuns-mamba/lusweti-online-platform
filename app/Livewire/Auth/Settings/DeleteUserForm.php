<?php 

declare(strict_types=1);

namespace App\Livewire\Auth\Settings;

use Illuminate\Contracts\View\View;
use Livewire\Component;
use Livewire\Attributes\Layout;

#[Layout('components.layouts.app')]
class DeleteUserForm extends Component
{
    /**
     * Renders the account deletion section.
     */
    public function render(): View
    {
        return view('livewire.auth.settings.delete-user-form');
    }
}