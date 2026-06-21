<x-layouts.app :title="$gallery->title">
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
                <a href="{{ route('galleries.index') }}" class="text-slate-400 hover:text-white transition-colors">
                    ← Back to Galleries
                </a>
                <h1 class="text-3xl font-bold mt-4">{{ $gallery->title }}</h1>
                @if($gallery->category)
                    <span class="inline-block mt-2 text-sm px-3 py-1 rounded-full bg-white/5 text-slate-300">
                        {{ $gallery->category->name }}
                    </span>
                @endif
            </div>
        </header>

        <main class="mx-auto max-w-[1600px] px-4 py-8 lg:px-8">
            @if($gallery->getFirstMediaUrl('gallery_cover'))
                <div class="mb-8 rounded-2xl overflow-hidden bg-slate-900">
                    <img 
                        src="{{ $gallery->getFirstMediaUrl('gallery_cover') }}" 
                        alt="{{ $gallery->title }}"
                        class="w-full h-auto"
                    >
                </div>
            @endif

            <div class="grid grid-cols-1 gap-4 md:grid-cols-2 lg:grid-cols-3">
                @foreach($gallery->media as $media)
                    <div class="rounded-2xl overflow-hidden bg-slate-900 border border-white/5">
                        <img
                            src="{{ $media->getUrl() }}"
                            alt="{{ $media->name }}"
                            class="w-full h-auto object-cover hover:scale-105 transition-transform duration-300"
                        >
                    </div>
                @endforeach
            </div>

            @if($gallery->media->count() === 0)
                <div class="text-center py-12">
                    <p class="text-slate-400">No images in this gallery.</p>
                </div>
            @endif

            <div class="mt-6">
                <p class="text-slate-400 text-sm">
                    Published: {{ $gallery->published_at->format('F j, Y g:i A') }}
                </p>
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
        </main>
    </div>
</x-layouts.app>
