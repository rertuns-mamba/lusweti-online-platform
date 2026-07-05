<div>
    
    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($this->category && $this->collectionItems->isNotEmpty()): ?>

    <section id="<?php echo e($this->page?->slug ?? 'videos-section'); ?>" class="w-full py-10 mx-auto bg-white text-slate-900 antialiased">

        
        <div class="flex flex-col sm:flex-row sm:items-end sm:justify-between mb-8 border-b-2 border-slate-900 pb-3 gap-4">
            <div class="flex items-start gap-3">
                <div class="w-3 h-8 shrink-0 rounded-none block"
                    style="background-color: <?php echo e($this->page?->bg_color ?? '#111827'); ?>">
                </div>

                <div class="space-y-1">
                    <h2 class="text-2xl  font-black tracking-tight text-neutral-900 uppercase">
                        <?php echo e($this->category->title); ?>

                    </h2>
                    <p class="text-xs font-normal text-neutral-500">
                        <?php echo e($this->settings['subtitle'] ?? 'Watch the latest videos and featured coverage'); ?>

                    </p>
                </div>
            </div>

            <a href="/<?php echo e($this->page?->slug ?? 'videos'); ?>"
                wire:navigate
                class="inline-flex items-center gap-1 text-xs font-bold uppercase tracking-wider text-slate-500 hover:text-slate-900 transition-colors">
                View All <?php echo e($this->category->title); ?>

                <span class="text-sm font-normal">&rarr;</span>
            </a>
        </div>

        
        <div class="grid grid-cols-1 gap-6 sm:grid-cols-2 lg:grid-cols-4">

            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $this->collectionItems; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $video): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?>
            <?php
                preg_match('/(?:youtu\.be\/|youtube\.com\/(?:watch\?v=|embed\/|shorts\/))([^&?\/]+)/', $video->video_url ?? '', $youtubeMatches);
                $youtubeId = $youtubeMatches[1] ?? ($video->youtube_id ?? null);
            ?>
            
            
            <article
                <?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::$currentLoop['key'] = 'video-teaser-'.e($video->id).''; ?>wire:key="video-teaser-<?php echo e($video->id); ?>"
                x-data="{
                    previewing: false,
                    playVideo() {
                        this.previewing = true;
                        if(this.$refs.videoElement) {
                            this.$refs.videoElement.play().catch(e => console.warn('Preview blocked:', e));
                        }
                    },
                    resetVideo() {
                        this.previewing = false;
                        if(this.$refs.videoElement) {
                            this.$refs.videoElement.pause();
                            this.$refs.videoElement.currentTime = 0;
                        }
                    }
                }"
                @mouseenter="playVideo"
                @mouseleave="resetVideo"
                @focusin="playVideo"
                @focusout="resetVideo"
                class="group bg-white border border-neutral-200 rounded-none shadow-none text-neutral-900 flex flex-col relative">
                
                
                <a href="<?php echo e(route('article.show', [$this->page?->slug ?? 'videos', $video->slug])); ?>"
                    wire:navigate
                    class="block h-full bg-transparent outline-none focus:ring-2 focus:ring-slate-900 focus:ring-offset-2 cursor-pointer">

                    <div class="relative aspect-video w-full overflow-hidden bg-slate-900 rounded-none mb-3">

                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($video->is_youtube && $youtubeId): ?>
                        <img src="https://i.ytimg.com/vi/<?php echo e($youtubeId); ?>/maxresdefault.jpg"
                            alt="<?php echo e($video->title); ?>"
                            loading="lazy"
                            class="w-full h-full object-cover transition-transform duration-700 ease-out group-hover:scale-105 group-focus:scale-105">
                        <?php else: ?>
                        
                        <video
                            x-ref="videoElement"
                            src="<?php echo e($video->getFirstMediaUrl('local_video') ?: $video->video_url); ?>"
                            preload="metadata"
                            loop
                            muted
                            playsinline
                            class="w-full h-full object-cover">
                        </video>
                        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

                        <div class="absolute bottom-0 left-0 bg-slate-900/90 text-white text-[10px] font-black uppercase tracking-widest px-2.5 py-1.5 flex items-center gap-1.5 transition-opacity duration-300"
                            x-bind:class="previewing ? 'opacity-0' : 'opacity-100'">
                            <svg class="w-3 h-3 fill-current text-red-600" viewBox="0 0 24 24">
                                <path d="M8 5v14l11-7z" />
                            </svg>
                            <span>Watch</span>
                        </div>

                        <div class="absolute bottom-0 right-0 bg-slate-950/70 text-white text-[10px] font-bold px-2 py-1.5 transition-opacity duration-300"
                            x-bind:class="previewing ? 'opacity-0' : 'opacity-100'">
                            <?php echo e(\Carbon\Carbon::parse($video->published_at)->isoFormat('MMM D')); ?>

                        </div>
                    </div>

                    <div class="space-y-1">
                        <div class="text-[10px] font-bold text-slate-400 uppercase tracking-wider flex items-center gap-1.5">
                            <span class="text-red-600 font-extrabold"><?php echo e($this->category->title); ?></span>
                        </div>

                        <h3 class="text-base font-bold leading-snug text-slate-900 group-hover:underline group-focus:underline tracking-tight line-clamp-3">
                            <?php echo e($video->title); ?>

                        </h3>
                    </div>
                </a>
            </article>
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>

        </div>

        
        <div class="mt-8 px-4 text-center md:hidden">
            <a href="/<?php echo e($this->page?->slug ?? 'videos'); ?>"
                wire:navigate
                class="block w-full py-3 bg-slate-900 text-white text-xs font-bold uppercase tracking-wider rounded-none transition-colors hover:bg-slate-800">
                View All Videos &rarr;
            </a>
        </div>

        
        <div class="mt-12 border-t border-b border-slate-200 py-3 text-center rounded-none bg-transparent">
            <span class="text-[9px] font-black uppercase tracking-widest text-slate-400 block">ADVERTISEMENT</span>
        </div>

    </section>

    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
</div><?php /**PATH E:\livestream-apps\lusweti-online-center\resources\views\livewire\sections\videos.blade.php ENDPATH**/ ?>