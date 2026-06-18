<div class="w-full py-10 mx-auto bg-white text-slate-900 antialiased font-sans">
    @if($this->featuredItem)
    
        {{-- BBC EDITORIAL HEADER --}}
        <div class="mb-8 flex flex-col sm:flex-row sm:items-end sm:justify-between border-b-2 border-slate-900 pb-3 gap-4">
            <div class="flex items-center gap-4">
                <a href="/ms/{{ $this->category->slug }}"
                    wire:navigate
                    class="inline-block text-xs font-black uppercase tracking-widest px-3 py-1.5 rounded-none"
                    style="background-color: {{ $page?->bg_color ?? '#111827' }}; color: {{ $page?->text_color ?? '#ffffff' }};">
                    {{ $this->category->title }}
                </a>
                <span class="h-4 w-[1px] bg-slate-300 hidden sm:inline"></span>
                <span class="text-xs font-bold uppercase tracking-wider text-slate-500">Latest Updates</span>
            </div>
        </div>

        {{-- ASYMMETRIC EDITORIAL GRID --}}
        <div class="grid grid-cols-1 gap-8 lg:grid-cols-3 lg:gap-8 lg:items-start">

            {{-- COLUMN 1: FEATURED STORY TEXT INTERACTION --}}
            <section class="border-b border-slate-200 pb-6 lg:border-b-0 lg:pb-0">
                <a href="/ms/{{ $this->category->slug }}/{{ $this->featuredItem->slug }}"
                    wire:navigate
                    class="group block h-full">
                    
                    <div class="space-y-3">
                        <h3 class="text-xl sm:text-2xl font-extrabold leading-tight tracking-tight text-slate-950 group-hover:underline decoration-1">
                            {{ $this->featuredItem->title }}
                        </h3>

                        <p class="text-sm leading-relaxed text-slate-600 font-normal">
                            {{ $this->featuredItem->summary }}
                        </p>

                        <div class="pt-1 flex items-center gap-2 text-[10px] font-bold uppercase tracking-wider text-slate-400">
                            <span class="font-extrabold tracking-normal" style="color: {{ $page?->bg_color ?? '#b91c1c' }}">{{ $this->category->title }}</span>
                            <span class="text-slate-300 font-normal">|</span>
                            <span>{{ $this->featuredItem->published_at?->diffForHumans(null, true, true) }} ago</span>
                        </div>
                    </div>
                </a>
            </section>

            {{-- COLUMN 2: FEATURED STORY WIDESCREEN MEDIA FRAME --}}
            <section class="border-b border-slate-200 pb-6 lg:border-b-0 lg:pb-0">
                <a href="/ms/{{ $this->category->slug }}/{{ $this->featuredItem->slug }}"
                    wire:navigate
                    class="group block">
                    
                    <div class="relative overflow-hidden rounded-none bg-slate-100 aspect-video w-full">
                        <img src="{{ $this->featuredItem->getFirstMediaUrl('featured_image', 'hero') }}"
                            alt="{{ $this->featuredItem->title }}"
                            loading="lazy"
                            class="w-full h-full object-cover transition-transform duration-500 ease-out group-hover:scale-105">
                    </div>
                </a>
            </section>

            {{-- COLUMN 3: STRUCTURED FEED SIDEBAR (SCROLLABLE VAULT) --}}
            <section class="flex flex-col h-full">
                <div class="mb-3 text-xs font-black uppercase tracking-wider border-b border-slate-100 pb-2 flex-shrink-0" style="color: {{ $page?->bg_color ?? '#b91c1c' }}">
                    More From {{ $this->category->title }}
                </div>

                {{-- Scroll Container: Aligns heights on desktop layouts --}}
                <div class="editorial-feed-scroll overflow-y-auto pr-2 lg:max-h-[340px]">
                    <ol class="divide-y divide-slate-100">
                        @foreach($this->standardItems as $item)
                        <li class="py-3.5 first:pt-0 last:pb-0">
                            <a href="/ms/{{ $this->category->slug }}/{{ $item->slug }}"
                                wire:navigate
                                class="group block space-y-1.5">

                                <h3 class="text-sm font-bold leading-snug text-slate-900 group-hover:underline tracking-tight">
                                    @if($item->is_prime)
                                    <span class="inline-block text-[9px] font-black tracking-widest px-1.5 py-0.5 bg-slate-950 text-white rounded-none mr-1.5 align-middle">
                                        PRIME
                                    </span>
                                    @endif
                                    <span class="align-middle">{{ $item->title }}</span>
                                </h3>

                                <div class="flex items-center gap-2 text-[10px] font-bold uppercase tracking-wider text-slate-400">
                                    <span class="font-extrabold tracking-normal" style="color: {{ $page?->bg_color ?? '#b91c1c' }}">{{ $this->category->title }}</span>
                                    <span class="text-slate-300 font-normal">|</span>
                                    <span>{{ $item->published_at?->diffForHumans(null, true, true) }} ago</span>
                                </div>
                            </a>
                        </li>
                        @endforeach
                    </ol>
                </div>
            </section>

        </div>
    @endif
</div>
