<div>
    {{-- Alpine wrapper for smooth transitions and focus trapping --}}
    <div 
        x-data="{ show: @entangle('isOpen') }"
        x-show="show"
        x-on:keydown.escape.window="$wire.closeModal()"
        class="relative z-50"
        aria-labelledby="slide-over-title" 
        role="dialog" 
        aria-modal="true"
        style="display: none;"
    >
        {{-- Background Backdrop --}}
        <div 
            x-show="show"
            x-transition:enter="ease-out duration-300"
            x-transition:enter-start="opacity-0"
            x-transition:enter-end="opacity-100"
            x-transition:leave="ease-in duration-200"
            x-transition:leave-start="opacity-100"
            x-transition:leave-end="opacity-0"
            class="fixed inset-0 bg-neutral-900/80 backdrop-blur-sm transition-opacity"
            x-on:click="$wire.closeModal()"
        ></div>

        {{-- Modal Panel --}}
        <div class="fixed inset-0 z-10 w-screen overflow-y-auto">
            <div class="flex min-h-full items-end justify-center p-4 text-center sm:items-center sm:p-0">
                <div 
                    x-show="show"
                    x-transition:enter="ease-out duration-300"
                    x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                    x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
                    x-transition:leave="ease-in duration-200"
                    x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
                    x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                    class="relative transform overflow-hidden bg-white text-left shadow-2xl transition-all sm:my-8 sm:w-full sm:max-w-4xl border-t-4 border-red-600"
                >
                    
                    @if($article)
                        {{-- Close Button --}}
                        <div class="absolute right-0 top-0 pr-4 pt-4 z-10">
                            <button 
                                type="button" 
                                wire:click="closeModal"
                                class="bg-white text-neutral-400 hover:text-red-600 focus:outline-none transition-colors p-1 rounded"
                            >
                                <span class="sr-only">Close</span>
                                <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                                </svg>
                            </button>
                        </div>

                        {{-- Article Content Area --}}
                        <div class="bg-white px-6 pb-8 pt-10 sm:px-12 sm:pb-12 sm:pt-14">
                            <div class="max-w-3xl mx-auto">
                                
                                {{-- Meta tag --}}
                                <div class="mb-4 flex items-center gap-3">
                                    <span class="text-xs font-bold text-red-600 uppercase tracking-wider">
                                        {{ $article->category->name ?? 'News' }}
                                    </span>
                                    <span class="text-xs text-neutral-500 font-sans">
                                        {{ $article->published_at ? \Carbon\Carbon::parse($article->published_at)->format('j M Y, H:i T') : $article->created_at->format('j M Y, H:i T') }}
                                    </span>
                                </div>

                                {{-- Title --}}
                                <h1 class="text-3xl sm:text-4xl font-bold text-neutral-900 leading-tight mb-6 font-sans tracking-tight">
                                    {{ $article->title }}
                                </h1>

                                {{-- DYNAMIC MEDIA PREVIEW HUB (Better Visuals Execution) --}}
                                <div class="my-6 w-full bg-black clear-both">
                                    @if($article->video_url || $article->is_youtube)
                                        {{-- Video Rendering Module --}}
                                        @php
                                            preg_match('/(?:youtu\.be\/|youtube\.com\/(?:watch\?v=|embed\/|shorts\/))([^&?\/]+)/', $article->video_url ?? '', $modalYoutubeMatches);
                                            $modalYoutubeId = $modalYoutubeMatches[1] ?? ($article->youtube_id ?? null);
                                        @endphp

                                        <div class="relative aspect-video w-full overflow-hidden shadow-md">
                                            @if(($article->is_youtube || str_contains($article->video_url, 'youtube.com') || str_contains($article->video_url, 'youtu.be')) && $modalYoutubeId)
                                                <iframe class="w-full h-full" src="https://www.youtube.com/embed/{{ $modalYoutubeId }}?autoplay=1" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                                            @else
                                                <video src="{{ $article->getFirstMediaUrl('local_video') ?: $article->video_url }}" controls autoplay playsinline class="w-full h-full object-contain"></video>
                                            @endif
                                        </div>
                                    @elseif($article->getFirstMediaUrl('featured_image') || $article->image_path || $article->getFirstMediaUrl('images'))
                                        {{-- Image/Gallery Feature Module --}}
                                        <div class="relative aspect-video w-full overflow-hidden shadow-md">
                                            <img src="{{
                                                $article->getFirstMediaUrl('featured_image')
                                                    ?: $article->getFirstMediaUrl('images')
                                                    ?: $article->image_path
                                            }}" class="w-full h-full object-cover" alt="{{ $article->title }}">
                                        </div>
                                    @endif
                                </div>

                                {{-- Lead Paragraph (Standfirst) --}}
                                @if($article->excerpt)
                                    <p class="text-lg text-neutral-700 font-serif mb-6 leading-relaxed italic border-l-4 border-slate-300 pl-4">
                                        {{ $article->excerpt }}
                                    </p>
                                @endif

                                {{-- Main Body Text --}}
                                <div class="prose prose-lg prose-neutral max-w-none font-serif text-neutral-800 leading-relaxed marker:text-red-600">
                                    {!! $article->content !!}
                                </div>
                            </div>
                        </div>
                        
                        {{-- Footer Action Area --}}
                        <div class="bg-neutral-50 border-t border-neutral-200 px-6 py-4 sm:px-12 flex justify-between items-center">
                            <div class="flex items-center space-x-3">
                                <span class="text-sm font-bold text-neutral-900">Share:</span>
                                {{-- Social media handles can be injected here --}}
                            </div>
                            @if($article->external_url)
                                <a href="{{ $article->external_url }}" target="_blank" class="text-sm font-bold text-red-600 hover:text-red-700 transition-colors">
                                    Read source &rarr;
                                </a>
                            @endif
                        </div>
                    @else
                        {{-- Loading State --}}
                        <div class="p-12 text-center text-neutral-500 font-sans animate-pulse">
                            Loading item details...
                        </div>
                    @endif

                </div>
            </div>
        </div>
    </div>
</div>