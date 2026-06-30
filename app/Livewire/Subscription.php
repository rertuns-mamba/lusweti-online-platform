<?php

namespace App\Livewire;

use App\Mail\NewSubscriberNotification;
use App\Mail\SubscriptionConfirmation;
use App\Models\Subscriber;
use Illuminate\Support\Facades\Mail;
use Livewire\Component;
use Livewire\Attributes\Layout;

#[Layout('components.layouts.app')]
class Subscription extends Component
{
    public string $email = '';
    public string $name = '';
    public string $phone_number = '';

    protected array $rules = [
        'email' => 'required|email|unique:subscribers,email',
        'name' => 'required|string|max:255',
        'phone_number' => 'required|string|max:255',
    ];

    public function subscribe()
    {
        $this->validate();

        $subscriber = Subscriber::create([
            'name' => $this->name,
            'email' => $this->email,
            'phone_number' => $this->phone_number,
            'is_active' => true,
            'subscribed_at' => now(),
        ]);

        // Send confirmation email to user
        try {
            Mail::to($subscriber->email)->send(new SubscriptionConfirmation($subscriber));
        } catch (\Exception $e) {
            \Log::error('Failed to send subscription confirmation email: ' . $e->getMessage());
        }

        // Send notification email to admin
        try {
            $adminEmail = config('mail.admin_email', 'admin@lusweti.com');
            Mail::to($adminEmail)->send(new NewSubscriberNotification($subscriber));
        } catch (\Exception $e) {
            \Log::error('Failed to send new subscriber notification email: ' . $e->getMessage());
        }

        session()->flash('success', 'Thank you for subscribing!');

        $this->reset(['email', 'name', 'phone_number']);
    }

    public function render()
    {
        return view('livewire.subscription');
    }
}
