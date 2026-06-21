<x-filament-panels::page>
    <x-filament-panels::form wire:submit="save">
        
        {{-- This renders the schema you built in your PHP class --}}
        {{ $this->form }}
        
        {{-- This adds the native Filament submit button --}}
        <x-filament-panels::form.actions 
            :actions="[
                \Filament\Actions\Action::make('save')
                    ->label('Save Settings')
                    ->submit('save')
            ]" 
        />
        
    </x-filament-panels::form>
</x-filament-panels::page>




