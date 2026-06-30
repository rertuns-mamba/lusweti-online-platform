<div class="max-w-screen-2xl mx-auto  py-8" x-data="{
    isDown: false,
    startX: 0,
    scrollLeft: 0,
    scrollNext() {
        this.$refs.slider.scrollBy({ left: window.innerWidth < 768 ? 280 : 400, behavior: 'smooth' });
    },
    scrollPrev() {
        this.$refs.slider.scrollBy({ left: window.innerWidth < 768 ? -280 : -400, behavior: 'smooth' });
    }
}">


    
    <div class="max-w-7xl mx-auto mb-8 w-full">

        
        <div class="flex items-center justify-between border-t-2 border-[#B80000]  pt-3 border-b-2 border-gray-900 pb-2">

            
            <div>
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($this->category): ?>
                    <a href="/cbs/<?php echo e($this->category->slug); ?>" wire:navigate
                        class="inline-block px-3 py-1 text-xs font-black uppercase tracking-widest rounded-none transition-opacity hover:opacity-90"
                        style="background: <?php echo e($this->category->bg_color ?? '#e50000'); ?>; color: <?php echo e($this->category->text_color ?? '#ffffff'); ?>;">
                        <?php echo e($this->category->name); ?>

                    </a>
                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
            </div>

            
            <div class="flex items-center gap-2">
                <button @click="scrollPrev()"
                    class="p-2 rounded-full bg-gray-100 hover:bg-gray-200 text-gray-900 transition-colors focus:outline-none"
                    aria-label="Scroll left">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7">
                        </path>
                    </svg>
                </button>

                <button @click="scrollNext()"
                    class="p-2 rounded-full bg-gray-100 hover:bg-gray-200 text-gray-900 transition-colors focus:outline-none"
                    aria-label="Scroll right">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                    </svg>
                </button>
            </div>

        </div>
    </div>

    
    <div x-ref="slider"
        @mousedown="isDown = true; startX = $event.pageX - $refs.slider.offsetLeft; scrollLeft = $refs.slider.scrollLeft; $refs.slider.classList.add('cursor-grabbing');"
        @mouseleave="isDown = false; $refs.slider.classList.remove('cursor-grabbing');"
        @mouseup="isDown = false; $refs.slider.classList.remove('cursor-grabbing');"
        @mousemove="if(!isDown) return; $event.preventDefault(); const x = $event.pageX - $refs.slider.offsetLeft; const walk = (x - startX) * 2; $refs.slider.scrollLeft = scrollLeft - walk;"
        class="flex gap-6 overflow-x-auto snap-x snap-mandatory pb-8 cursor-grab scroll-smooth hide-scrollbars">
        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $feedItems; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?>
            <?php
                $isVideo = $item->type === 'video';

                $videoUrl = $isVideo
                    ? ($item->video_url ?:
                    ($item->youtube_id
                        ? "https://www.youtube.com/watch?v={$item->youtube_id}"
                        : null))
                    : null;

                $youtubeId = null;
                if ($item->video_url) {
                    preg_match(
                        '/(?:youtu\.be\/|youtube\.com\/(?:watch\?v=|embed\/|shorts\/))([^&?\/]+)/',
                        $item->video_url,
                        $youtubeMatches,
                    );
                    $youtubeId = $youtubeMatches[1] ?? null;
                }
                if (!$youtubeId && !empty($item->youtube_id)) {
                    $youtubeId = $item->youtube_id;
                }

                $targetUrl = $isVideo
                    ? ($videoUrl ?:
                    '#')
                    : route('article.show', [$item->category->slug ?? 'news', $item->slug]);

                $posterUrl = $isVideo
                    ? ($item->is_youtube && $youtubeId
                        ? "https://i.ytimg.com/vi/{$youtubeId}/maxresdefault.jpg"
                        : ($item->getFirstMediaUrl('custom_thumbnail') ?:
                        $item->getFirstMediaUrl('featured_image') ?:
                        $item->featured_image_thumb_url ?:
                        $item->image_path ?:
                        $item->getFirstMediaUrl('images') ?:
                        asset('images/placeholders/article-default.jpg')))
                    : ($item->featured_image_thumb_url ?:
                    $item->getFirstMediaUrl('featured_image', 'thumb') ?:
                    $item->getFirstMediaUrl('featured_image') ?:
                    $item->getFirstMediaUrl('images') ?:
                    $item->image_path ?:
                    asset('images/placeholders/article-default.jpg'));

                $previewUrl =
                    $isVideo && !$item->is_youtube ? ($item->getFirstMediaUrl('local_video') ?: $videoUrl) : null;
            ?>

            
            <article x-data="{
                playing: false,
                initVideoObserver() {
                    if (!this.$refs.container) return;
                    let observer = new IntersectionObserver(entries => {
                        entries.forEach(entry => {
                            this.playing = entry.isIntersecting;
                        });
                    }, { threshold: 0.5 });
                    observer.observe(this.$refs.container);
                }
            }" <?php if($isVideo): ?>
                x-init="initVideoObserver()"
        <?php endif; ?>
        @mouseenter="playing = true"
        @mouseleave="playing = false"
        class="flex flex-col bg-white rounded-xl shadow-sm hover:shadow-xl transition-all duration-300 overflow-hidden group min-w-[280px] sm:min-w-[320px] max-w-[320px] shrink-0 snap-start">

        
        <a href="<?php echo e($targetUrl); ?>" <?php if(!$isVideo): ?> wire:navigate <?php endif; ?>
            class="relative block w-full aspect-video overflow-hidden bg-gray-100 select-none" x-ref="container"
            draggable="false">
            
            <img src="<?php echo e($posterUrl); ?>" alt="<?php echo e($item->title); ?>"
                class="absolute inset-0 w-full h-full object-cover transition-transform duration-700 group-hover:scale-105 pointer-events-none"
                loading="lazy" draggable="false">

            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($isVideo): ?>
                
                <video x-ref="video"
                    x-effect="if(playing) { $el.play().catch(()=>{}) } else { $el.pause(); $el.currentTime = 0; }"
                    :class="playing ? 'opacity-100' : 'opacity-0'" muted loop playsinline preload="none"
                    class="absolute inset-0 w-full h-full object-cover transition-opacity duration-500 z-10 pointer-events-none">
                    <source src="<?php echo e($previewUrl); ?>" type="video/mp4">
                </video>

                
                <div :class="playing ? 'opacity-0 scale-95' : 'opacity-100 scale-100'"
                    class="absolute inset-0 flex items-center justify-center bg-black/20 z-20 transition-all duration-300 pointer-events-none">
                    <div class="bg-white/30 backdrop-blur-md rounded-full p-3 shadow-lg">
                        <svg class="w-8 h-8 text-white drop-shadow-md" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd"
                                d="M10 18a8 8 0 100-16 8 8 0 000 16zM9.555 7.168A1 1 0 008 8v4a1 1 0 001.555.832l3-2a1 1 0 000-1.664l-3-2z"
                                clip-rule="evenodd" />
                        </svg>
                    </div>
                </div>

                
                <div
                    class="absolute bottom-2 right-2 bg-black/75 backdrop-blur-sm text-white text-xs font-semibold px-2 py-1 rounded z-20">
                    <?php echo e($item->duration ?? '0:00'); ?>

                </div>
            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
        </a>

        
        <div class="p-5 flex flex-col flex-grow select-none">
            <span
                class="text-xs font-bold <?php echo e($isVideo ? 'text-red-600' : 'text-blue-600'); ?> uppercase tracking-wider mb-2">
                <?php echo e($item->category->name ?? ($isVideo ? 'Video' : 'News')); ?>

            </span>

            <h3 class="text-lg font-bold text-gray-900 mb-2 leading-tight line-clamp-2">
                <a href="<?php echo e($targetUrl); ?>" class="hover:text-blue-600 transition-colors"
                    <?php if(!$isVideo): ?> wire:navigate <?php endif; ?> draggable="false">
                    <?php echo e($item->title); ?>

                </a>
            </h3>

            <div class="mt-auto pt-4 flex items-center justify-between text-sm text-gray-500 border-t border-gray-100">
                <time datetime="<?php echo e($item->published_at->toIso8601String()); ?>">
                    <?php echo e($item->published_at->diffForHumans()); ?>

                </time>
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($isVideo): ?>
                    <span class="flex items-center gap-1" title="Views">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z">
                            </path>
                        </svg>
                        <?php echo e(number_format($item->views_count ?? 0)); ?>

                    </span>
                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
            </div>
        </div>
        </article>
        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
    </div>
</div>
<?php /**PATH E:\livestream-apps\lusweti-online-center\resources\views/livewire/sections/most-featured.blade.php ENDPATH**/ ?>