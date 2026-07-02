<x-layouts.app :title="__('Videos')">
    <div class="min-h-screen bg-white text-gray-900 font-sans antialiased">
        
        <header class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 pt-12 pb-6 border-b-4 border-gray-900">
            <h1 class="text-4xl sm:text-5xl md:text-6xl font-extrabold text-gray-900 tracking-tight mb-2">
                Videos
            </h1>
            <p class="text-gray-500 text-lg font-medium">
                Browse all video content
            </p>
        </header>

        <main class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 py-10">
            @if($videos->count() > 0)
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-x-6 gap-y-12">
                    @foreach($videos as $video)
                        <article class="group relative flex flex-col h-full cursor-pointer">
                            <a href="{{ route('videos.show', $video->slug) }}" class="absolute inset-0 z-10">
                                <span class="sr-only">Watch {{ $video->title }}</span>
                            </a>

                            <div class="aspect-video overflow-hidden bg-black mb-4 relative">
                                
                                @if($video->is_youtube && $video->youtube_id)
                                    <img 
                                        src="https://img.youtube.com/vi/{{ $video->youtube_id }}/hqdefault.jpg" 
                                        alt="{{ $video->title }}"
                                        loading="lazy"
                                        class="w-full h-full object-cover opacity-90 transform group-hover:scale-105 transition-all duration-500 ease-out"
                                    >
                                @elseif($video->getFirstMediaUrl('local_video'))
                                    @if($video->getFirstMediaUrl('custom_thumbnail'))
                                        <img 
                                            src="{{ $video->getFirstMediaUrl('custom_thumbnail') }}" 
                                            alt="{{ $video->title }}"
                                            loading="lazy"
                                            class="w-full h-full object-cover opacity-90 transform group-hover:scale-105 transition-all duration-500 ease-out"
                                        >
                                    @else
                                        <img 
                                            src="{{ $video->getFirstMediaUrl('local_video', 'thumb') }}" 
                                            alt="{{ $video->title }}"
                                            loading="lazy"
                                            class="w-full h-full object-cover opacity-90 transform group-hover:scale-105 transition-all duration-500 ease-out"
                                        >
                                    @endif
                                @else
                                    <div class="w-full h-full bg-gray-100 flex items-center justify-center border border-gray-200">
                                        <svg class="w-8 h-8 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z" />
                                        </svg>
                                    </div>
                                @endif

                                <div class="absolute bottom-3 left-3 bg-gray-900 text-white px-2 py-1 flex items-center text-xs font-bold uppercase tracking-wider group-hover:bg-red-600 transition-colors duration-300 pointer-events-none shadow-sm">
                                    <svg class="w-3 h-3 mr-1.5 fill-current" viewBox="0 0 24 24">
                                        <path d="M8 5v14l11-7z"/>
                                    </svg>
                                    Watch
                                </div>
                            </div>

                            <div class="flex flex-col flex-grow">
                                @if($video->category)
                                    <span class="text-red-600 font-bold text-xs uppercase tracking-wider mb-2">
                                        {{ $video->category->name }}
                                    </span>
                                @endif

                                <h2 class="text-xl font-bold text-gray-900 leading-tight mb-2 group-hover:underline decoration-2 underline-offset-4 line-clamp-2">
                                    {{ $video->title }}
                                </h2>

                                <time datetime="{{ $video->published_at->toIso8601String() }}" class="text-sm text-gray-500 font-medium mt-auto pt-2">
                                    {{ $video->published_at->format('j F Y') }}
                                </time>
                            </div>
                        </article>
                    @endforeach
                </div>

                <div class="mt-16 pt-8 border-t border-gray-200 flex justify-center">
                    {{ $videos->appends(request()->query())->links() }}
                </div>
            @else
                <div class="flex flex-col items-center justify-center py-20 border-2 border-dashed border-gray-200">
                    <svg class="w-12 h-12 text-gray-300 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z" />
                    </svg>
                    <p class="text-gray-500 font-medium text-lg">No videos found.</p>
                </div>
            @endif
        </main>
    </div>
</x-layouts.app>