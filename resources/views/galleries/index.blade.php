<x-layouts.app :title="__('Galleries')">
    <div class="min-h-screen bg-white text-gray-900 font-sans antialiased">
        
        <header class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 pt-12 pb-6 border-b-4 border-gray-900">
            <h1 class="text-4xl sm:text-5xl md:text-6xl font-extrabold text-gray-900 tracking-tight mb-2">
                Galleries
            </h1>
            <p class="text-gray-500 text-lg font-medium">
                Browse all photo galleries
            </p>
        </header>

        <main class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 py-10">
            @if($galleries->count() > 0)
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-x-6 gap-y-12">
                    @foreach($galleries as $gallery)
                        <article class="group relative flex flex-col h-full cursor-pointer">
                            <a href="{{ route('galleries.show', $gallery->slug) }}" target="_blank" class="absolute inset-0 z-10">
                                <span class="sr-only">View {{ $gallery->title }}</span>
                            </a>

                            @if($gallery->getFirstMediaUrl('gallery_cover'))
                                <div class="aspect-[16/9] overflow-hidden bg-gray-100 mb-4">
                                    <img 
                                        src="{{ $gallery->getFirstMediaUrl('gallery_cover', 'grid-thumb') }}" 
                                        alt="{{ $gallery->title }}"
                                        loading="lazy"
                                        class="w-full h-full object-cover transform group-hover:scale-105 transition-transform duration-500 ease-out"
                                    >
                                </div>
                            @else
                                <div class="aspect-[16/9] bg-gray-50 mb-4 flex items-center justify-center border border-gray-200">
                                    <svg class="w-8 h-8 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                    </svg>
                                </div>
                            @endif

                            <div class="flex flex-col flex-grow">
                                @if($gallery->category)
                                    <span class="text-red-600 font-bold text-xs uppercase tracking-wider mb-2">
                                        {{ $gallery->category->name }}
                                    </span>
                                @endif

                                <h2 class="text-xl font-bold text-gray-900 leading-tight mb-2 group-hover:underline decoration-2 underline-offset-4 line-clamp-2">
                                    {{ $gallery->title }}
                                </h2>

                                <time datetime="{{ $gallery->published_at->toIso8601String() }}" class="text-sm text-gray-500 font-medium mt-auto pt-2">
                                    {{ $gallery->published_at->format('j F Y') }}
                                </time>
                            </div>
                        </article>
                    @endforeach
                </div>

                <div class="mt-16 pt-8 border-t border-gray-200 flex justify-center">
                    {{ $galleries->appends(request()->query())->links() }}
                </div>
            @else
                <div class="flex flex-col items-center justify-center py-20 border-2 border-dashed border-gray-200">
                    <svg class="w-12 h-12 text-gray-300 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                    </svg>
                    <p class="text-gray-500 font-medium text-lg">No galleries found.</p>
                </div>
            @endif
        </main>
    </div>
</x-layouts.app>















