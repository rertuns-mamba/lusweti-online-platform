<x-layouts.app>
    <livewire:global.page-header />
    
    <div class="bg-white min-h-screen antialiased"
        x-data="{ 
            percent: 0, 
            copied: false, 
            copyToClipboard() {
                navigator.clipboard.writeText(window.location.href);
                this.copied = true;
                setTimeout(() => this.copied = false, 2000);
            }
        }"
        x-on:scroll.window="percent = (window.pageYOffset / (document.documentElement.scrollHeight - window.innerHeight)) * 100">

        {{-- BBC STYLE PROGRESS BAR --}}
        <div class="fixed top-0 left-0 w-full h-[3px] z-[60] pointer-events-none">
            <div class="h-full bg-red-600 transition-all duration-150 ease-out will-change-[width]" 
                 :style="'width: ' + percent + '%'"></div>
        </div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pt-8 pb-16">

            {{-- BBC STYLE BACK NAVIGATION --}}
            <div class="mb-6 flex items-center">
                <a href="{{ route('home') }}" wire:navigate
                    class="inline-flex items-center gap-2 px-4 py-2 rounded-full bg-slate-100 hover:bg-slate-200 text-xs font-bold uppercase tracking-widest text-slate-800 shadow-sm transition-all duration-200">

                    <svg class="w-4 h-4 animate-pulse" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                    </svg>

                    Back to {{ $article->page->title ?? 'Home' }}
                </a>
            </div>

            {{-- BBC STYLE ARTICLE --}}
            <article class="max-w-4xl mx-auto">

                {{-- BBC STYLE CATEGORY & DATE HEADER --}}
                <header class="mb-6 space-y-3">
                    <div class="flex items-center gap-3">
                        @if($article->category)
                        <span class="inline-block text-xs font-black uppercase tracking-widest text-white px-3 py-1.5 rounded-none"
                            style="background: {{ $article->page->bg_color ?? '#dc2626' }};">
                            {{ $article->category->name }}
                        </span>
                        @endif
                        <span class="text-xs font-bold text-slate-500 uppercase tracking-wider">
                            {{ $article->published_at?->format('j M Y, H:i') ?? $article->created_at->format('j M Y, H:i') }}
                        </span>
                    </div>

                    <h1 class="text-3xl sm:text-4xl md:text-5xl font-black text-slate-900 leading-tight tracking-tight">
                        {{ $article->title }}
                    </h1>
                </header>

                {{-- BBC STYLE MEDIA SECTION --}}
                <div class="mb-8">
                    @if($article->video_url || $article->is_youtube)
                        {{-- YouTube Video --}}
                        @php
                            preg_match('/(?:youtu\.be\/|youtube\.com\/(?:watch\?v=|embed\/|shorts\/))([^&?\/]+)/', $article->video_url ?? '', $youtubeMatches);
                            $youtubeId = $youtubeMatches[1] ?? ($article->youtube_id ?? null);
                        @endphp

                        @if($youtubeId)
                        <div class="relative aspect-video w-full bg-black overflow-hidden shadow-lg">
                            <iframe src="https://www.youtube.com/embed/{{ $youtubeId }}?rel=0&modestbranding=1&playsinline=1" 
                                class="w-full h-full"
                                frameborder="0"
                                allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                                allowfullscreen 
                                loading="lazy"
                                title="{{ $article->title }}">
                            </iframe>

                            @if($article->external_url)
                            <a href="{{ $article->external_url }}"
                                target="_blank"
                                rel="noopener noreferrer"
                                class="absolute top-4 right-4 z-50 px-4 py-2 text-xs font-bold text-white bg-red-600 rounded-lg backdrop-blur-sm transition-all duration-300 hover:bg-red-700 shadow-lg pointer-events-auto"
                                style="background: linear-gradient(135deg, #dc2626 0%, #ef4444 100%) !important;">
                                Watch on YouTube
                                <svg class="w-4 h-4 ml-2 inline" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M19.615 3.654c-1.318-.72-3.43-.743-8.614-.743-5.185 0-7.298.023-8.616.743C2.047 4.374.96 5.42.96 8.05v7.9c0 2.678 1.113 3.754 2.425 4.396 1.32.72 3.43.743 8.614.743 5.186 0 7.298-.023 8.616-.743 1.312-.642 2.42-1.718 2.42-4.396V8.05c0-2.678-1.113-3.754-2.425-4.396zM8.5 15.5V8.5l7 3.5-7 3.5z" />
                                </svg>
                            </a>
                            @endif
                        </div>
                        @endif
                    @elseif($article->featured_image_url)
                        {{-- Featured Image --}}
                        <div class="relative aspect-video w-full bg-slate-100 overflow-hidden shadow-lg">
                            <img src="{{ $article->featured_image_url }}" 
                                alt="{{ $article->title }}" 
                                loading="lazy"
                                class="w-full h-full object-cover">

                            @if($article->external_url)
                            <a href="{{ $article->external_url }}"
                                target="_blank"
                                rel="noopener noreferrer"
                                onclick="window.open(this.href, '_blank'); return false;"
                                class="absolute top-4 right-4 z-50 px-4 py-2 text-xs font-bold text-white bg-red-600 rounded-lg backdrop-blur-sm transition-all duration-300 hover:bg-red-700 shadow-lg pointer-events-auto"
                                style="background: linear-gradient(135deg, #dc2626 0%, #ef4444 100%) !important;">
                                Visit Source
                                <svg class="w-4 h-4 ml-2 inline" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14" />
                                </svg>
                            </a>
                            @endif
                        </div>
                    @endif
                </div>

                {{-- BBC STYLE CONTENT --}}
                <div class="space-y-6">
                    {{-- Summary/Standfirst --}}
                    @if($article->summary)
                    <p class="text-lg sm:text-xl text-slate-700 font-serif leading-relaxed italic border-l-4 border-red-600 pl-4">
                        {{ $article->summary }}
                    </p>
                    @endif

                    {{-- Main Content --}}
                    <div class="prose prose-lg prose-slate max-w-none font-serif text-slate-800 leading-relaxed">
                        {!! $article->content !!}
                    </div>

                    {{-- External URL Info --}}
                    @if($article->external_url)
                    <div class="bg-slate-50 rounded-lg p-4 border border-slate-200">
                        <h3 class="text-sm font-bold text-slate-700 mb-2 uppercase tracking-wider">External Source</h3>
                        <a href="{{ $article->external_url }}"
                            target="_blank"
                            rel="noopener noreferrer"
                            onclick="window.open(this.href, '_blank'); return false;"
                            class="text-red-600 hover:text-red-700 break-all text-sm font-semibold">
                            {{ $article->external_url }}
                        </a>
                    </div>
                    @endif
                </div>

                {{-- BBC STYLE SHARE SECTION --}}
                <div class="pt-8 border-t-2 border-slate-900 mt-8">
                    <div class="flex flex-wrap items-center gap-3 sm:gap-4">

                        <span class="text-sm font-bold text-slate-800 uppercase tracking-wider">Share</span>

                        {{-- X/Twitter --}}
                        <a href="https://twitter.com/intent/tweet?url={{ urlencode(url()->current()) }}&text={{ urlencode($article->title) }}"
                            target="_blank"
                            class="p-3 rounded-full bg-slate-100 text-slate-600 hover:bg-slate-200 hover:text-black transition-all duration-200 border border-transparent">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M18.901 1.153h3.68l-8.04 9.19L24 22.846h-7.406l-5.8-7.584-6.638 7.584H.474l8.6-9.83L0 1.154h7.594l5.243 6.932ZM17.61 20.644h2.039L6.486 3.24H4.298Z" />
                            </svg>
                        </a>

                        {{-- LinkedIn --}}
                        <a href="https://www.linkedin.com/sharing/share-offsite/?url={{ urlencode(url()->current()) }}"
                            target="_blank"
                            class="p-3 rounded-full bg-slate-100 text-slate-600 hover:bg-slate-200 hover:text-blue-700 transition-all duration-200 border border-transparent">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M20.447 20.452h-3.554v-5.569c0-1.328-.027-3.037-1.852-3.037-1.853 0-2.136 1.445-2.136 2.939v5.667H9.351V9h3.414v1.561h.046c.477-.9 1.637-1.85 3.37-1.85 3.601 0 4.267 2.37 4.267 5.455v6.286zM5.337 7.433c-1.144 0-2.063-.926-2.063-2.065 0-1.138.92-2.063 2.063-2.063 1.14 0 2.064.925 2.064 2.063 0 1.139-.925 2.065-2.064 2.065zm1.782 13.019H3.555V9h3.564v11.452z"/>
                            </svg>
                        </a>

                        {{-- Copy Link --}}
                        <div class="relative">
                            <button @click="copyToClipboard"
                                class="p-3 rounded-full bg-slate-100 text-slate-600 hover:bg-slate-200 hover:text-red-600 transition-all duration-200 border border-transparent">
                                
                                <svg x-show="!copied" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 5H6a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2v-1M8 5a2 2 0 002 2h2a2 2 0 002-2"/>
                                </svg>

                                <svg x-show="copied" class="w-5 h-5 text-green-600" fill="none" viewBox="0 0 24 24" stroke="currentColor" x-cloak>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                </svg>
                            </button>

                            <span x-show="copied"
                                x-transition
                                class="absolute -bottom-9 left-1/2 -translate-x-1/2 bg-slate-900 text-white text-[10px] px-2 py-1 rounded shadow">
                                Copied!
                            </span>
                        </div>

                    </div>
                </div>

            </article>
        </div>

        {{-- BBC STYLE RELATED ARTICLES --}}
        @if($relatedArticles->count() > 0)
        <section class="bg-slate-50 border-t-2 border-slate-900 py-10">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

                <div class="flex flex-col sm:flex-row sm:items-end sm:justify-between gap-3 mb-6">
                    <div>
                        <h3 class="text-2xl sm:text-3xl font-black text-slate-900">More from {{ $article->category->name ?? 'Articles' }}</h3>
                        <div class="h-1 w-16 bg-red-600 mt-2"></div>
                    </div>

                    <a href="{{ route('home') }}"
                        class="text-sm font-bold text-red-600 hover:text-red-700 flex items-center gap-2 uppercase tracking-wider">
                        View All
                        <span class="text-lg">&rarr;</span>
                    </a>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach($relatedArticles as $relatedArticle)
                    <a href="{{ route('article.show', [$article->page->slug ?? 'home', $relatedArticle->slug]) }}"
                        wire:navigate
                        class="group block bg-white rounded-none shadow-sm hover:shadow-md transition-shadow duration-200">
                        
                        @if($relatedArticle->featured_image_thumb_url)
                        <div class="aspect-video w-full bg-slate-100 overflow-hidden">
                            <img src="{{ $relatedArticle->featured_image_thumb_url }}" 
                                alt="{{ $relatedArticle->title }}" 
                                loading="lazy"
                                class="w-full h-full object-cover transition-transform duration-300 group-hover:scale-105">
                        </div>
                        @endif

                        <div class="p-4">
                            <h4 class="text-sm font-bold text-slate-900 group-hover:text-red-600 transition-colors line-clamp-2 leading-snug">
                                {{ $relatedArticle->title }}
                            </h4>

                            <div class="flex items-center gap-2 mt-2 text-[10px] font-bold text-slate-500 uppercase tracking-wider">
                                <span>{{ $relatedArticle->category->name ?? 'News' }}</span>
                                <span>•</span>
                                <span>{{ $relatedArticle->published_at?->diffForHumans() ?? $relatedArticle->created_at->diffForHumans() }}</span>
                            </div>
                        </div>
                    </a>
                    @endforeach
                </div>

            </div>
        </section>
        @endif

    </div>
</x-layouts.app>
