<div class="w-full bg-[#B80000] border-b-4 border-black">
    @if($this->hasBreaking())
    <div wire:key="breaking-ticker"
        class="text-white text-sm font-bold flex items-stretch overflow-hidden h-10">

        {{-- STARK GEOMETRIC STATIC BADGE --}}
        <div class="px-4 bg-black text-white uppercase tracking-widest font-black shrink-0 z-20 flex items-center gap-3 border-r-2 border-[#B80000]">
            <span class="w-2.5 h-2.5 bg-red-600 animate-pulse" aria-hidden="true"></span>
            <span class="text-xs md:text-sm pt-0.5">Breaking</span>
        </div>

        {{-- EDITORIAL SCROLLING TRACK --}}
        <div class="flex-1 overflow-hidden whitespace-nowrap flex items-center relative z-10">
            <div class="ticker-track hover:pause flex items-center">

                {{-- Loop duplicates content for a seamless, infinite track scroll --}}
                @for ($i = 0; $i < 4; $i++)
                    <div class="flex items-center shrink-0" wire:key="ticker-group-{{ $i }}">
                    @foreach ($this->breakingItems as $item)
                    @php
                    $isInternal = str_starts_with($item->url, config('app.url')) || str_starts_with($item->url, '#');
                    @endphp

                    <div class="flex items-center gap-3 px-6 border-l border-red-800/50 first:border-l-0 h-6" wire:key="breaking-{{ $item->id }}-{{ $i }}">

                        @if($item->is_live)
                        <span class="bg-white animate-pulse text-[#B80000] px-1.5 py-0.5 text-[10px] font-black tracking-widest uppercase block select-none leading-none">
                            Live
                        </span>
                        @endif

                        <a href="{{ $item->url }}"
                            @if($isInternal) wire:navigate.hover @else target="_blank" rel="noopener noreferrer" @endif
                            class="text-white text-sm font-bold tracking-normal hover:underline underline-offset-4 decoration-2 transition-none pt-0.5">
                            {{ $item->display_title ?? $item->title }}
                        </a>
                    </div>
                    @endforeach
            </div>
            @endfor

        </div>
    </div>

</div>
@endif
</div>