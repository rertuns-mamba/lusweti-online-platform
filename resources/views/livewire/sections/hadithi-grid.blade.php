<div>
    @if($this->category && $this->columnLayouts['featured'])
    <section class="py-10 text-slate-900 antialiased bg-white">

        {{-- BBC EDITORIAL HEADER --}}
        <div class="mb-8 flex flex-col sm:flex-row sm:items-end sm:justify-between border-b-2 border-slate-900 pb-3 gap-4">
            <div class="flex flex-wrap items-center gap-3 sm:gap-4">
                <a href="/ms/{{ $section->page->slug }}" 
                    class="inline-block text-xs font-black uppercase tracking-widest px-3 py-1.5 rounded-none"
                    style="background-color: {{ $section->page->bg_color }}; color: {{ $section->page->text_color }};">
                    {{ $this->category->name }}
                </a>
                <span class="text-xs font-bold uppercase tracking-wider text-slate-500">Latest Hadithi</span>
            </div>
            <a href="/ms/{{ $section->page->slug }}" class="text-xs font-bold uppercase text-slate-500 hover:text-slate-900">See All &rarr;</a>
        </div>

        <div class="grid grid-cols-1 gap-8 lg:grid-cols-12 lg:gap-6">
            {{-- COLUMN 1: LEAD --}}
            <div class="lg:col-span-4 border-b border-slate-200 pb-6 lg:border-b-0 lg:pb-0">
                @php $hero = $this->columnLayouts['featured']; @endphp
                <a href="/ms/{{ $section->page->slug }}/{{ $hero->slug }}" class="group block space-y-3.5">
                    <div class="relative overflow-hidden aspect-video bg-slate-100">
                        <img src="{{ $hero->getFirstMediaUrl('featured_image', 'hero') }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                    </div>
                    <h3 class="text-xl font-extrabold text-slate-950 group-hover:underline">{{ $hero->title }}</h3>
                    <p class="text-sm text-slate-600 line-clamp-3">{{ $hero->summary }}</p>
                </a>
            </div>

            {{-- COLUMN 2: THUMBNAILS --}}
            <div class="lg:col-span-4 border-b border-slate-200 pb-6 lg:border-b-0 lg:pb-0 space-y-4">
                @foreach($this->columnLayouts['thumbnails'] as $item)
                <a href="/ms/{{ $section->page->slug }}/{{ $item->slug }}" class="group flex gap-4 border-b border-slate-100 pb-4 last:border-0 items-start">
                    <div class="h-16 w-24 flex-shrink-0 overflow-hidden bg-slate-100">
                        <img src="{{ $item->getFirstMediaUrl('featured_image', 'thumb') }}" class="w-full h-full object-cover">
                    </div>
                    <div class="min-w-0">
                        <h3 class="text-sm font-bold text-slate-950 group-hover:underline line-clamp-2">{{ $item->title }}</h3>
                        <p class="text-[10px] font-bold text-slate-400 uppercase mt-1">{{ $item->published_at->diffForHumans() }}</p>
                    </div>
                </a>
                @endforeach
            </div>

            {{-- COLUMN 3: TEXT-ONLY --}}
            <div class="lg:col-span-4 space-y-4">
                @foreach($this->columnLayouts['textOnly'] as $item)
                <a href="/ms/{{ $section->page->slug }}/{{ $item->slug }}" class="group block border-l-2 border-slate-200 pl-4 hover:border-slate-900 transition-colors">
                    <h3 class="text-sm font-bold text-slate-800 group-hover:text-slate-950 group-hover:underline line-clamp-2">{{ $item->title }}</h3>
                    <p class="text-[10px] font-bold text-slate-400 uppercase mt-1">{{ $item->published_at->diffForHumans() }}</p>
                </a>
                @endforeach
            </div>
        </div>
    </section>
    @endif
</div>