<x-layouts.app>
    <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8 space-y-12">
        {{-- Inside resources/views/pages/show.blade.php --}}
        @foreach($page->sections as $section)
        @livewire($section->component, [
        'page' => $page,
        'section' => $section, 
        // {{-- ADDED: Passes the current section model instance --}}
        'settings' => $section->settings ?? [] 
        // {{-- ADDED: Passes the configuration array safely --}}
        ], key($section->id))
        @endforeach
        
    </main>
</x-layouts.app>