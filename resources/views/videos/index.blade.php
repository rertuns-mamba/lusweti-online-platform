<x-layouts.app :title="__('Videos')">
    <div class="min-h-screen bg-slate-950 text-slate-100">
        <header class="border-b border-white/5 bg-slate-950/80 backdrop-blur-lg">
            <div class="mx-auto max-w-[1600px] px-4 py-6 lg:px-8">
                <h1 class="text-3xl font-bold">Videos</h1>
                <p class="text-slate-400 mt-2">Browse all video content</p>
            </div>
        </header>

        <main class="mx-auto max-w-[1600px] px-4 py-8 lg:px-8">
            @if($videos->count() > 0)
                <div class="grid grid-cols-1 gap-6 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4">
                    @foreach($videos as $video)
                        <a href="{{ route('videos.show', $video->slug) }}" class="group">
                            <div class="overflow-hidden rounded-2xl bg-slate-900 border border-white/5 hover:border-white/10 transition-all">
                                @if($video->is_youtube && $video->youtube_id)
                                    <div class="aspect-video bg-slate-800 relative">
                                        <img 
                                            src="https://img.youtube.com/vi/{{ $video->youtube_id }}/hqdefault.jpg" 
                                            alt="{{ $video->title }}"
                                            class="w-full h-full object-cover"
                                        >
                                        <div class="absolute inset-0 flex items-center justify-center bg-black/30 opacity-0 group-hover:opacity-100 transition-opacity">
                                            <div class="w-16 h-16 rounded-full bg-red-600 flex items-center justify-center">
                                                <svg class="w-8 h-8 text-white ml-1" fill="currentColor" viewBox="0 0 24 24">
                                                    <path d="M8 5v14l11-7z"/>
                                                </svg>
                                            </div>
                                        </div>
                                    </div>
                                @elseif($video->getFirstMediaUrl('local_video'))
                                    <div class="aspect-video bg-slate-800 relative">
                                        @if($video->getFirstMediaUrl('custom_thumbnail'))
                                            <img 
                                                src="{{ $video->getFirstMediaUrl('custom_thumbnail') }}" 
                                                alt="{{ $video->title }}"
                                                class="w-full h-full object-cover"
                                            >
                                        @else
                                            <img 
                                                src="{{ $video->getFirstMediaUrl('local_video', 'thumb') }}" 
                                                alt="{{ $video->title }}"
                                                class="w-full h-full object-cover"
                                            >
                                        @endif
                                        <div class="absolute inset-0 flex items-center justify-center bg-black/30 opacity-0 group-hover:opacity-100 transition-opacity">
                                            <div class="w-16 h-16 rounded-full bg-red-600 flex items-center justify-center">
                                                <svg class="w-8 h-8 text-white ml-1" fill="currentColor" viewBox="0 0 24 24">
                                                    <path d="M8 5v14l11-7z"/>
                                                </svg>
                                            </div>
                                        </div>
                                    </div>
                                @else
                                    <div class="aspect-video bg-slate-800 flex items-center justify-center">
                                        <span class="text-slate-500">No thumbnail</span>
                                    </div>
                                @endif

                                <div class="p-4">
                                    <h3 class="font-semibold text-white group-hover:text-red-500 transition-colors line-clamp-2">
                                        {{ $video->title }}
                                    </h3>
                                    @if($video->category)
                                        <span class="inline-block mt-2 text-xs px-2 py-1 rounded-full bg-white/5 text-slate-400">
                                            {{ $video->category->name }}
                                        </span>
                                    @endif
                                    <p class="text-xs text-slate-500 mt-2">
                                        {{ $video->published_at->format('M j, Y') }}
                                    </p>
                                </div>
                            </div>
                        </a>
                    @endforeach
                </div>

                <div class="mt-8 flex justify-center">
                    {{ $videos->appends(request()->query())->links() }}
                </div>
            @else
                <div class="text-center py-12">
                    <p class="text-slate-400">No videos found.</p>
                </div>
            @endif
        </main>
    </div>
</x-layouts.app>
