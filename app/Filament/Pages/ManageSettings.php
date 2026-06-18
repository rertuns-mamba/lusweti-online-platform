<?php

namespace App\Filament\Pages;

use App\Models\SiteSetting;
use Filament\Forms\Form;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Section; // Fixed namespace
use Filament\Pages\Page;
use Filament\Forms\Contracts\HasForms; // Required for forms on custom pages
use Filament\Forms\Concerns\InteractsWithForms; // Required for forms on custom pages
use Filament\Notifications\Notification;

class ManageSettings extends Page implements HasForms
{
    use InteractsWithForms; // Injects the form logic

    protected static string | \BackedEnum | null $navigationIcon = 'heroicon-o-cog-6-tooth';
    protected static ?string $navigationLabel = 'Site Settings';
    
    // Kept as static to comply with Filament v3 base Page architecture
    protected string $view = 'filament.pages.manage-settings';

    public ?array $data = [];

    public function mount(): void
    {
        // Fill the form using the 'data' array defined by statePath()
        $this->form->fill(SiteSetting::current()->toArray());
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('Global Branding')
                    ->schema([
                        TextInput::make('tagline')
                            ->required(),
                        DatePicker::make('display_date')
                            ->required(),
                    ]),
            ])
            ->statePath('data'); // Binds the form state to the public $data array
    }

    public function save(): void
    {
        SiteSetting::current()->update($this->form->getState());
        
        Notification::make()
            ->success()
            ->title('Settings saved')
            ->send();
    }
}