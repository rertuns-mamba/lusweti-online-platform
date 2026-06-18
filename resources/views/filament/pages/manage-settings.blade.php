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



{{-- 

// <x-filament-panels::page>
//     <form wire:submit="save">
//         {{ $this->form }}

//         <div class="mt-4">
//             <x-filament::button type="submit">
//                 Save Settings
//             </x-filament::button>
//         </div>
//     </form>
// </x-filament-panels::page>


--}}
