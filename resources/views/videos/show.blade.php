<x-layouts.app :title="$video->title">
    @push('scripts')
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                if (window.Echo) {
                    // Listen for article mutations on the magazine-stream channel
                    window.Echo.channel('magazine-stream')
                        .listen('.article.mutated', (event) => {
                            // Reload the page to get updated related articles
                            window.location.reload();
                        });

                    // Also listen on the specific article channels if we have related articles
                    @if($relatedArticles->count() > 0)
                        @foreach($relatedArticles as $article)
                            window.Echo.channel('articles.{{ $article->id }}')
                                .listen('.article.mutated', (event) => {
                                    window.location.reload();
                                });
                        @endforeach
                    @endif
                }
            });
        </script>
    @endpush

    <div class="min-h-screen bg-slate-950 text-slate-100">
        <header class="border-b border-white/5 bg-slate-950/80 backdrop-blur-lg">
            <div class="mx-auto max-w-[1600px] px-4 py-6 lg:px-8">
                <a href="{{ route('videos.index') }}" class="text-slate-400 hover:text-white transition-colors">
                    ← Back to Videos
                </a>
                <h1 class="text-3xl font-bold mt-4">{{ $video->title }}</h1>
                @if($video->category)
                    <span class="inline-block mt-2 text-sm px-3 py-1 rounded-full bg-white/5 text-slate-300">
                        {{ $video->category->name }}
                    </span>
                @endif
            </div>
        </header>

        <main class="mx-auto max-w-[1600px] px-4 py-8 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                <div class="lg:col-span-2">
                    @if($video->is_youtube && $video->youtube_id)
                        <div class="aspect-video rounded-2xl overflow-hidden bg-slate-900">
                            <iframe 
                                src="https://www.youtube.com/embed/{{ $video->youtube_id }}" 
                                class="w-full h-full"
                                frameborder="0" 
                                allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" 
                                allowfullscreen>
                            </iframe>
                        </div>
                    @elseif($video->getFirstMediaUrl('local_video'))
                        <div class="aspect-video rounded-2xl overflow-hidden bg-slate-900">
                            <video 
                                controls 
                                class="w-full h-full"
                                poster="{{ $video->getFirstMediaUrl('custom_thumbnail') ?? $video->getFirstMediaUrl('local_video', 'thumb') }}">
                                <source src="{{ $video->getFirstMediaUrl('local_video') }}" type="video/mp4">
                                Your browser does not support the video tag.
                            </video>
                        </div>
                    @else
                        <div class="aspect-video rounded-2xl bg-slate-900 flex items-center justify-center">
                            <span class="text-slate-500">Video not available</span>
                        </div>
                    @endif

                    <div class="mt-6">
                        <p class="text-slate-400 text-sm">
                            Published: {{ $video->published_at->format('F j, Y g:i A') }}
                        </p>
                    </div>
                </div>

                <aside class="space-y-6">
                    <div class="rounded-2xl border border-white/5 bg-slate-900 p-6">
                        <h3 class="font-bold mb-4">Share Video</h3>
                        <div class="flex gap-2">
                            <button class="flex-1 px-4 py-2 rounded-lg bg-white/5 hover:bg-white/10 transition-colors text-sm">
                                Copy Link
                            </button>
                        </div>
                    </div>
                </aside>
            </div>

            @if($relatedArticles->count() > 0)
                <div class="mt-12 border-t border-white/5 pt-8">
                    <h2 class="text-2xl font-bold mb-6">Related Articles</h2>
                    <div class="grid grid-cols-1 gap-6 md:grid-cols-2 lg:grid-cols-3">
                        @foreach($relatedArticles as $article)
                            <a href="{{ route('article.show', [$article->page->slug ?? 'home', $article->slug]) }}" class="group">
                                <div class="rounded-2xl overflow-hidden bg-slate-900 border border-white/5 hover:border-white/10 transition-all">
                                    @if($article->getFirstMediaUrl('featured_image'))
                                        <div class="aspect-video bg-slate-800">
                                            <img
                                                src="{{ $article->getFirstMediaUrl('featured_image', 'thumb') }}"
                                                alt="{{ $article->title }}"
                                                class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300"
                                            >
                                        </div>
                                    @endif
                                    <div class="p-4">
                                        <h3 class="font-semibold text-white group-hover:text-red-500 transition-colors line-clamp-2">
                                            {{ $article->title }}
                                        </h3>
                                        @if($article->category)
                                            <span class="inline-block mt-2 text-xs px-2 py-1 rounded-full bg-white/5 text-slate-400">
                                                {{ $article->category->name }}
                                            </span>
                                        @endif
                                        <p class="text-xs text-slate-500 mt-2">
                                            {{ $article->published_at->format('M j, Y') }}
                                        </p>
                                    </div>
                                </div>
                            </a>
                        @endforeach
                    </div>
                </div>
            @endif
            </div>
        </main>
    </div>
</x-layouts.app>
