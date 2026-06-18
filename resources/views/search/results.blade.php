<x-layouts.app :title="__('home')">
    <div class="container mx-auto py-10 max-w-4xl">
        <h1 class="text-2xl text-white mb-6 font-bold font-sans tracking-tight">
            Search Results for: "{{ $query }}"
        </h1>

        <div class="bg-neutral-900 border border-neutral-800 rounded-lg overflow-hidden">
            {{-- YOUR LOOP GOES HERE --}}
            @foreach($results as $result)
                <div class="p-4 border-b border-neutral-800 last:border-b-0 hover:bg-neutral-800/50 transition-colors">
                    <span class="text-xs text-red-600 font-bold uppercase tracking-wider">
                        {{ $result['type'] }}
                    </span>
                    
                    {{-- The Livewire Trigger Button --}}
                    <button 
                        type="button"
                        wire:click="$dispatch('open-article-preview', { article: {{ $result['id'] }} })" 
                        class="block text-left text-lg text-neutral-100 hover:text-red-500 transition-colors w-full font-bold mt-2 font-sans"
                    >
                        {{ $result['title'] }}
                    </button>
                </div>
            @endforeach

            {{-- Empty State --}}
            @if($results->isEmpty())
                <div class="p-8 text-center text-neutral-500 font-sans">
                    No results found for "{{ $query }}". Please try a different search term.
                </div>
            @endif
        </div>
    </div>
</x-layouts.app>