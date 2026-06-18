<div>
    @php
        $count = max($articles->count(), 1);

        /*
        |--------------------------------------------------------------------------
        | Dynamic Radius Allocation
        |--------------------------------------------------------------------------
        | Maintains proper 3D transform depth balancing based on item totals.
        */
        if ($count <= 4) {
            $mobileRadius = 140;
            $tabletRadius = 190;
            $desktopRadius = 240;
        } elseif ($count <= 6) {
            $mobileRadius = 170;
            $tabletRadius = 230;
            $desktopRadius = 290;
        } else {
            $mobileRadius = 190;
            $tabletRadius = 260;
            $desktopRadius = 330;
        }
    @endphp

    <section class="relative w-full py-12 md:py-16 overflow-hidden bg-white font-sans">

        {{-- Category Identity Banner --}}
        @if($this->category)
                <div class="mx-auto max-w-7xl mx-auto  mb-6">
                    <div class="border-t-2 border-[#B80000] pt-3">
                        <div class="flex items-end justify-between border-b-2 border-gray-900 pb-2">
                            <a href="/ms/{{ $this->category->slug }}"
                                wire:navigate
                                class="inline-block px-3 py-1 text-xs font-black uppercase tracking-widest rounded-none transition-opacity hover:opacity-90"
                                style="background: {{ $this->category->bg_color ?? '#e50000' }}; color: {{ $this->category->text_color ?? '#ffffff' }};">
                                {{ $this->category->name }}
                            </a>
                        </div>
                    </div>
                </div>
        @endif

        

        {{-- 3D Rotation Engine --}}
        @if($articles->isNotEmpty())
            <div class="news-stage">
                <div class="news-spinner"
                     style="
                        --total: {{ $count }};
                        --mobile-radius: {{ $mobileRadius }}px;
                        --tablet-radius: {{ $tabletRadius }}px;
                        --desktop-radius: {{ $desktopRadius }}px;
                     ">
                     
                    @foreach($articles as $article)
                        <a href="/{{ $article->page->slug ?? 'category' }}/{{ $article->slug }}"
                           wire:navigate
                           class="news-card group"
                           style="--i: {{ $loop->iteration }}">
                           
                            <img src="{{
                                $article->featured_image_thumb_url
                                    ?: $article->getFirstMediaUrl('featured_image', 'thumb')
                                    ?: $article->getFirstMediaUrl('featured_image')
                                    ?: $article->getFirstMediaUrl('images')
                                    ?: $article->image_path
                                    ?: asset('images/placeholders/article-default.jpg')
                            }}"
                                 alt="{{ $article->title }}"
                                 loading="lazy">

                            <div class="news-overlay"></div>

                            <div class="news-content">
                                <span class="news-category">
                                    {{ $article->category->name ?? $this->category?->name ?? 'Latest' }}
                                </span>
                                <h3>
                                    <span class="hover-underline">
                                        {{ $article->title }}
                                    </span>
                                </h3>
                            </div>
                        </a>
                    @endforeach
                </div>
            </div>
        @else
            <div class="text-center text-gray-600 font-medium py-12 border-t border-gray-200 mx-4 max-w-6xl md:mx-auto">
                No news articles available at this time.
            </div>
        @endif

    </section>

    
</div>