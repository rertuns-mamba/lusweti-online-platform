<?php

declare(strict_types=1);

namespace App\Livewire\Auth\Settings;

use App\Concerns\PasswordValidationRules;
use App\Livewire\Actions\Logout;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

    use Livewire\Attributes\Layout;

    #[Layout('components.layouts.app')]


class DeleteUserModal extends Component
{
    use PasswordValidationRules;

    /**
     * Data binding for the verification password field.
     */
    public string $password = '';

    /**
     * Delete the currently authenticated user.
     * Enforces explicit dependency injection and strict typing.
     */
    public function deleteUser(Logout $logout): void
    {
        $this->validate([
            'password' => $this->currentPasswordRules(),
        ]);

        // Safely execute user deletion logic and session termination concurrently
        tap(Auth::user(), $logout(...))->delete();

        $this->redirect('/', navigate: true);
    }

    /**
     * Render layout node.
     */
    public function render(): View
    {
        return view('livewire.auth.settings.delete-user-modal');
    }
}