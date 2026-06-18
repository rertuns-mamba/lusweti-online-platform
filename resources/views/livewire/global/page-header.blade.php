<div class="w-full bg-white text-slate-900 border-b-2 border-slate-900">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex flex-col sm:flex-row items-center justify-between py-4">
            
            {{-- TAGLINE --}}
            <span class="text-[11px] font-black uppercase tracking-widest text-slate-500">
                {{ $tagline }}
            </span>
            
            {{-- DATE --}}
            <time class="mt-2 sm:mt-0 text-[11px] font-bold uppercase tracking-wider text-slate-400" 
                  datetime="{{ $formattedDate['iso'] }}">
                {{ $formattedDate['human'] }}
            </time>

        </div>
    </div>
</div>