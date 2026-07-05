<x-layouts.app :title="$gallery->title">
    {{-- Gallery show blade JS--}}

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
                    @if ($relatedArticles->count() > 0)
                        @foreach ($relatedArticles as $article)
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

    

    <article class="min-h-screen bg-white text-gray-900 font-sans antialiased">

        <header class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 pt-8 pb-6 border-b border-gray-200">
            <nav class="mb-6">
                <a href="{{ route('galleries.index') }}"
                    class="group flex items-center text-sm font-bold text-gray-500 hover:text-red-600 uppercase tracking-widest transition-colors">
                    <svg class="w-4 h-4 mr-2 transform group-hover:-translate-x-1 transition-transform" fill="none"
                        stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="square" stroke-linejoin="miter" stroke-width="2"
                            d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                    </svg>
                    All Galleries
                </a>
            </nav>

            <h1 class="text-4xl sm:text-5xl md:text-6xl font-extrabold text-gray-900 leading-tight mb-6 tracking-tight">
                {{ $gallery->title }}
            </h1>

            <div class="flex flex-wrap items-center gap-4 text-sm">
                @if ($gallery->category)
                    <span
                        class="inline-block px-3 py-1 font-bold text-white bg-red-600 uppercase tracking-wider text-xs">
                        {{ $gallery->category->name }}
                    </span>
                @endif

                <time datetime="{{ $gallery->published_at->toIso8601String() }}"
                    class="text-gray-500 font-medium flex items-center gap-2">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    Published: {{ $gallery->published_at->format('j F Y, H:i') }}
                </time>
            </div>
        </header>

        <main class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 py-8">

            @if ($gallery->getFirstMediaUrl('gallery_cover'))
                <figure class="mb-12">
                    <div class="w-full aspect-[16/9] md:aspect-[21/9] overflow-hidden bg-gray-100">
                        <img src="{{ $gallery->getFirstMediaUrl('gallery_cover') }}" alt="{{ $gallery->title }} Cover"
                            class="w-full h-full object-cover">
                    </div>
                </figure>
            @endif

            <section class="mb-16">
                @if ($gallery->media->count() > 0)
                    <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-1 sm:gap-2">
                        @foreach ($gallery->media as $media)
                            <a href="{{ $media->getUrl() }}" target="_blank"
                                class="block aspect-square overflow-hidden bg-gray-100 group">
                                <img src="{{ $media->getUrl() }}" alt="{{ $media->name }}" loading="lazy"
                                    class="w-full h-full object-cover transform group-hover:scale-105 transition-transform duration-500 ease-out">
                            </a>
                        @endforeach
                    </div>
                @else
                    <div class="flex flex-col items-center justify-center py-16 border-2 border-dashed border-gray-200">
                        <svg class="w-12 h-12 text-gray-300 mb-4" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                        </svg>
                        <p class="text-gray-500 font-medium">No images available in this gallery.</p>
                    </div>
                @endif
            </section>

            @if ($relatedArticles->count() > 0)
                <aside class="mt-16 pt-8 border-t-4 border-gray-900">
                    <h2 class="text-2xl font-bold text-gray-900 mb-8 uppercase tracking-wide flex items-center">
                        <span class="w-3 h-3 bg-red-600 mr-3 block"></span>
                        Related Content
                    </h2>

                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-x-6  gap-y-8">
                        @foreach ($relatedArticles as $article)
                            <article class="group relative flex flex-col h-full cursor-pointer">
                                <a href="{{ route('article.show', [$article->page->slug ?? 'home', $article->slug]) }}"
                                    class="absolute inset-0 z-10"><span class="sr-only">Read
                                        {{ $article->title }}</span></a>

                                @if ($article->getFirstMediaUrl('featured_image'))
                                    <div class="aspect-[16/9] overflow-hidden bg-gray-100 mb-4">
                                        <img src="{{ $article->getFirstMediaUrl('featured_image', 'thumb') }}"
                                            alt="{{ $article->title }}" loading="lazy"
                                            class="w-full h-full object-cover transform group-hover:scale-105 transition-transform duration-500 ease-out">
                                    </div>
                                @endif

                                <div class="flex flex-col flex-grow">
                                    @if ($article->category)
                                        <span class="text-red-600 font-bold text-xs uppercase tracking-wider mb-2">
                                            {{ $article->category->name }}
                                        </span>
                                    @endif

                                    <h3
                                        class="text-xl font-bold text-gray-900 leading-tight mb-2 group-hover:underline decoration-2 underline-offset-4">
                                        {{ $article->title }}
                                    </h3>

                                    <time datetime="{{ $article->published_at->toIso8601String() }}"
                                        class="text-sm text-gray-500 font-medium mt-auto pt-4">
                                        {{ $article->published_at->diffForHumans() }}
                                    </time>
                                </div>
                            </article>
                        @endforeach
                    </div>
                </aside>
            @endif

        </main>
    </article>
</x-layouts.app>