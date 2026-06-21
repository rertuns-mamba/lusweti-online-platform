<x-layouts.app :title="__('Galleries')">
    <div class="min-h-screen bg-slate-950 text-slate-100">
        <header class="border-b border-white/5 bg-slate-950/80 backdrop-blur-lg">
            <div class="mx-auto max-w-[1600px] px-4 py-6 lg:px-8">
                <h1 class="text-3xl font-bold">Galleries</h1>
                <p class="text-slate-400 mt-2">Browse all photo galleries</p>
            </div>
        </header>

        <main class="mx-auto max-w-[1600px] px-4 py-8 lg:px-8">
            @if($galleries->count() > 0)
                <div class="grid grid-cols-1 gap-6 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4">
                    @foreach($galleries as $gallery)
                        <a href="{{ route('galleries.show', $gallery->slug) }}" target="_blank" class="group">
                            <div class="overflow-hidden rounded-2xl bg-slate-900 border border-white/5 hover:border-white/10 transition-all">
                                @if($gallery->getFirstMediaUrl('gallery_cover'))
                                    <div class="aspect-[4/3] bg-slate-800 relative">
                                        <img 
                                            src="{{ $gallery->getFirstMediaUrl('gallery_cover', 'grid-thumb') }}" 
                                            alt="{{ $gallery->title }}"
                                            class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300"
                                        >
                                    </div>
                                @else
                                    <div class="aspect-[4/3] bg-slate-800 flex items-center justify-center">
                                        <span class="text-slate-500">No cover image</span>
                                    </div>
                                @endif

                                <div class="p-4">
                                    <h3 class="font-semibold text-white group-hover:text-red-500 transition-colors line-clamp-2">
                                        {{ $gallery->title }}
                                    </h3>
                                    @if($gallery->category)
                                        <span class="inline-block mt-2 text-xs px-2 py-1 rounded-full bg-white/5 text-slate-400">
                                            {{ $gallery->category->name }}
                                        </span>
                                    @endif
                                    <p class="text-xs text-slate-500 mt-2">
                                        {{ $gallery->published_at->format('M j, Y') }}
                                    </p>
                                </div>
                            </div>
                        </a>
                    @endforeach
                </div>

                <div class="mt-8 flex justify-center">
                    {{ $galleries->appends(request()->query())->links() }}
                </div>
            @else
                <div class="text-center py-12">
                    <p class="text-slate-400">No galleries found.</p>
                </div>
            @endif
        </main>
    </div>
</x-layouts.app>
