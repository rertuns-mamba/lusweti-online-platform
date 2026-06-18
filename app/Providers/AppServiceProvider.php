<?php

namespace App\Providers;

use Carbon\CarbonImmutable;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;
use Illuminate\Validation\Rules\Password;
use Livewire\Livewire;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Gate::before(function ($user, $ability) {
            return $user->hasRole('Super Admin') ? true : null;
        });
        $this->configureDefaults();
    }

    /**
     * Configure default behaviors for production-ready applications.
     */
    protected function configureDefaults(): void
    {
        Date::use(CarbonImmutable::class);

        DB::prohibitDestructiveCommands(
            app()->isProduction(),
        );

        Password::defaults(fn (): ?Password => app()->isProduction()
            ? Password::min(12)
                ->mixedCase()
                ->letters()
                ->numbers()
                ->symbols()
                ->uncompromised()
            : null,
        );


        // Map the database alias strings to your actual Livewire classes
        Livewire::component('sections.hero', \App\Livewire\Sections\Hero::class);
        Livewire::component('sections.spoti-majuu-block', \App\Livewire\Sections\SpotiMajuuBlock::class);
        
        // Add these as well once you create their files so they are ready to go:
        Livewire::component('sections.editorial-grid-block', \App\Livewire\Sections\EditorialGridBlock::class);
        Livewire::component('sections.videos', \App\Livewire\Sections\Videos::class);
        Livewire::component('sections.galleries', \App\Livewire\Sections\Galleries::class);
    }
}
