<form wire:submit.prevent="save" class="space-y-6">
    {{-- This renders the schema you built in your PHP class --}}
    {{ $this->form }}

    {{-- This adds the native Filament submit button --}}
    <x-filament::button type="submit">
        Save Settings
    </x-filament::button>
</form>




