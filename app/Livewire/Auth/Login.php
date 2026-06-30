<?php 


namespace App\Livewire\Auth;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\ValidationException;

use Livewire\Attributes\Layout;

#[Layout('components.layouts.app')]

class Login extends Component
{
    public string $email = '';
    public string $password = '';
    public bool $remember = false;

    protected array $rules = [
        'email' => 'required|email',
        'password' => 'required|string',
    ];

    public function authenticate()
    {
        $this->validate();

        $attempt = Auth::attempt(['email' => $this->email, 'password' => $this->password], $this->remember);

        if (!$attempt) {
            throw ValidationException::withMessages([
                'email' => __('auth.failed'),
            ]);
        }

        session()->regenerate();
        
        return redirect()->intended('/');
    }

    public function render()
    {
        return view('livewire.auth.login');
    }
}