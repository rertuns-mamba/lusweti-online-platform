<x-layouts.app :title="__('home')">
    <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8 space-y-12">

        {{-- Safely check if the page exists and has sections --}}
        @if(isset($page) && $page->sections->isNotEmpty())

            @foreach($page->sections as $section)
                @php
                    // Grab the component name from the database
                    $componentName = $section->component;
                    // Convert kebab-case to full Livewire class name
                    $className = collect(explode('.', $componentName))
                        ->map(fn($segment) => Illuminate\Support\Str::studly($segment))
                        ->join('\\');
                    $fullClassName = 'App\\Livewire\\' . $className;
                @endphp

                {{-- Verify the component class actually exists in Livewire's registry before rendering --}}
                @if($section->componentExists())
                    {{-- The correct Livewire 3 dynamic component syntax --}}
                    <livewire:dynamic-component
                        :is="$fullClassName"
                        :section="$section"
                        :key="'section-' . $section->id"
                    />
                @else
                    <div class="p-4 bg-red-50 border border-red-200 text-red-700 rounded-lg text-sm">
                        System Notice: The component alias <strong>[{{ $componentName }}]</strong> was found in the database, but the matching Livewire class could not be located.
                    </div>
                @endif
            @endforeach

        @else
            <div class="p-6 bg-yellow-50 border border-yellow-200 text-yellow-700 rounded-lg">
                {{ __('Homepage data has not been seeded yet.') }}
            </div>
        @endif

    </main>
</x-layouts.app>