<?php

namespace App\Models;

use Filament\Models\Contracts\FilamentUser;
use Filament\Panel; // <--- YOU MUST IMPORT THIS
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;
use App\Concerns\Searchable;

class User extends Authenticatable implements FilamentUser
{
    use HasRoles, HasFactory, Notifiable, Searchable;

    protected $fillable = ['name', 'first_name', 'email', 'password', 'phone_number', 'email_verified_at','google_id',
        'google_token',
        'google_refresh_token',
        'last_login_at',
        'last_login_ip',];
    protected $hidden = ['password', 'remember_token'];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime','last_login_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

     
   

    /**
     * Generate 2-letter uppercase initials for avatars.
     * This belongs strictly in the Eloquent Model.
     */
    public function getInitialsAttribute(): string
    {
        if (blank($this->name)) {
            return 'U';
        }

        return collect(explode(' ', $this->name))
            ->map(fn($segment) => mb_substr($segment, 0, 1))
            ->take(2)
            ->join('') ?? 'U';
    }

    // public function subscriptions(): HasMany
    // {
    //     // return $this->hasMany(Subscription::class);
    // }

    public function canAccessPanel(Panel $panel): bool
    {
        // Check if user has any of the required roles
        // Temporarily allow all authenticated users for debugging
        return true;
    }
}
