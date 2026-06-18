<section class="w-full py-10 bg-white text-neutral-900 antialiased font-sans">
    @if($this->category && $this->collectionItems->isNotEmpty())

    <div class="flex items-end justify-between border-b-2 border-neutral-900 pb-2 mb-6">
        <h2 class="text-xl font-black uppercase tracking-tight text-neutral-900 flex items-center gap-2.5">
            <span class="w-3 h-6 bg-red-600 rounded-none block" aria-hidden="true"></span>
            {{ $this->category->name }}
        </h2>
    </div>

    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
        @foreach($this->collectionItems as $article)
        <article wire:key="external-{{ $article->id }}" 
                 class="group relative flex flex-col bg-white border border-neutral-200">
            
            <a href="{{ $article->external_url }}" target="_blank" rel="noopener noreferrer" class="absolute inset-0 z-10"></a>

            <div class="relative aspect-[16/9] w-full overflow-hidden bg-neutral-100">
                <img src="{{ $article->featured_image_thumb_url }}" 
                     alt="{{ $article->title }}" 
                     loading="lazy"
                     class="w-full h-full object-cover">
                
                <div class="absolute top-0 right-0 inline-flex items-center gap-1 bg-neutral-950 text-white px-2 py-1 text-[9px] font-black uppercase">
                    <span>External</span>
                </div>
            </div>

            <div class="flex flex-col flex-1 p-4 relative z-20 space-y-4">
                <h3 class="text-sm font-extrabold text-neutral-900 leading-snug line-clamp-2 group-hover:underline">
                    {{ $article->title }}
                </h3>
                <p class="text-xs text-neutral-600 line-clamp-2">{{ $article->summary }}</p>

                <div class="pt-3 border-t border-neutral-100">
                    <time class="text-[10px] font-bold text-red-700 uppercase">{{ $article->published_at->diffForHumans() }}</time>
                    <p class="text-[10px] font-medium text-neutral-400 uppercase tracking-tight">
                        Source: {{ parse_url($article->external_url, PHP_URL_HOST) }}
                    </p>
                </div>
            </div>
        </article>
        @endforeach
    </div>
    @endif
</section>