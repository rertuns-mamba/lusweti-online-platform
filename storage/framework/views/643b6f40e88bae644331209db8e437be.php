<header class="bg-neutral-950 text-white relative py-4 z-50 border-b border-neutral-800 select-none">
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
        <div class="h-16 grid grid-cols-[1fr_auto_1fr] items-center gap-2 sm:gap-4 lg:gap-8">

            <div class="flex items-center justify-start min-w-0">
                <button id="menu-toggler"
                    class="flex items-center gap-2 text-neutral-400 hover:text-red-500 transition-colors group p-1 -ml-1 focus:outline-none">
                    <svg class="h-6 w-6 sm:h-7 sm:w-7 group-hover:scale-105 transition-transform shrink-0" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="square" stroke-linejoin="miter" stroke-width="2"
                            d="M4 6h16M4 12h16M4 18h16" />
                    </svg>
                    <span
                        class="hidden md:block text-sm font-bold uppercase tracking-widest group-hover:text-white transition-colors truncate">
                        <a href="">E Paper</a>
                    </span>
                </button>
            </div>

            <div class="flex items-center justify-center">
                <a href="/general-sports"
                    class="flex items-center space-x-2 sm:space-x-4 group outline-none focus-visible:ring-2 focus-visible:ring-red-600 rounded">
                    <div class="flex items-center space-x-[2px] shrink-0">
                        <span
                            class="bg-white text-black font-black px-1.5 sm:px-2 py-0.5 text-base sm:text-lg tracking-tighter uppercase group-hover:bg-red-600 group-hover:text-white transition-colors">C</span>
                        <span
                            class="bg-white text-black font-black px-1.5 sm:px-2 py-0.5 text-base sm:text-lg tracking-tighter uppercase group-hover:bg-red-600 group-hover:text-white transition-colors">B</span>
                        <span
                            class="bg-white text-black font-black px-1.5 sm:px-2 py-0.5 text-base sm:text-lg tracking-tighter uppercase group-hover:bg-red-600 group-hover:text-white transition-colors">S</span>
                    </div>
                    <span
                        class="text-xs sm:text-sm font-bold tracking-widest uppercase border-l border-neutral-700 pl-2 sm:pl-4 hidden sm:inline text-neutral-300 group-hover:text-white transition-colors whitespace-nowrap">
                        <?php echo e($brandName ?? 'Online Center'); ?>

                    </span>
                </a>
            </div>

            <div class="flex items-center justify-end gap-3 sm:gap-4 lg:gap-6 min-w-0">

                <form action="<?php echo e(route('search')); ?>" method="GET"
                    class="hidden lg:flex items-center min-w-[120px] max-w-[200px] xl:max-w-[240px] w-full">
                    <div
                        class="flex items-center w-full bg-neutral-900 border border-neutral-700 overflow-hidden focus-within:border-neutral-400 transition-colors">
                        <input type="text" name="query" placeholder="Search news..."
                            class="w-full min-w-0 bg-transparent px-3 py-1.5 text-sm text-white placeholder-neutral-500 focus:outline-none">
                        <button type="submit" aria-label="Submit Search"
                            class="bg-red-600 hover:bg-red-700 text-white px-3 py-1.5 transition-colors shrink-0">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 xl:h-5 xl:w-5" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M21 21l-4.35-4.35m0 0A7.5 7.5 0 105.65 5.65a7.5 7.5 0 0010.6 10.6z" />
                            </svg>
                        </button>
                    </div>
                </form>

                <button aria-label="Open Mobile Search"
                    class="lg:hidden text-neutral-400 hover:text-red-500 transition-colors p-1 shrink-0">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 sm:h-6 sm:w-6" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M21 21l-4.35-4.35m0 0A7.5 7.5 0 105.65 5.65a7.5 7.5 0 0010.6 10.6z" />
                    </svg>
                </button>

                <div class="hidden sm:block h-6 w-px bg-neutral-800 shrink-0"></div>

                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(auth()->guard()->check()): ?>
                    <div class="relative shrink-0" x-data="{ open: false }" @click.away="open = false">
                        <button @click="open = !open"
                            class="flex items-center space-x-3 focus:outline-none p-1 group rounded">
                            <span
                                class="text-xs sm:text-sm font-bold hidden md:inline-block tracking-wide text-neutral-300 group-hover:text-white transition-colors whitespace-nowrap">
                                <?php echo e(Auth::user()->name); ?>

                            </span>
                            <div
                                class="h-8 w-8 sm:h-9 sm:w-9 bg-neutral-800 border border-neutral-700 flex items-center justify-center overflow-hidden group-hover:border-red-600 transition-colors shrink-0">
                                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(Auth::user()->avatar_url): ?>
                                    <img src="<?php echo e(Auth::user()->avatar_url); ?>" alt="Profile Avatar"
                                        class="h-full w-full object-cover">
                                <?php else: ?>
                                    <span
                                        class="text-xs font-black tracking-wider text-red-500 uppercase"><?php echo e(Auth::user()->initials); ?></span>
                                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                            </div>
                        </button>

                        <div x-show="open" x-transition:enter="transition ease-out duration-100"
                            x-transition:enter-start="transform opacity-0 scale-95"
                            x-transition:enter-end="transform opacity-100 scale-100" x-cloak
                            class="absolute right-0 mt-3 w-56 bg-neutral-950 border border-neutral-800 shadow-2xl z-50 py-1 origin-top-right">

                            <div class="px-4 py-3 border-b border-neutral-900">
                                <p class="text-[10px] text-neutral-500 uppercase font-black tracking-widest mb-1">Account ID
                                </p>
                                <p class="text-xs font-medium truncate text-neutral-300"><?php echo e(Auth::user()->email); ?></p>
                            </div>

                            <a href="/profile"
                                class="block px-4 py-3 text-xs font-bold uppercase tracking-wider text-neutral-300 hover:bg-neutral-900 hover:text-white hover:border-l-2 hover:border-red-600 transition-all">
                                Settings & Profile
                            </a>

                            <form method="POST" action="<?php echo e(route('logout')); ?>" class="block border-t border-neutral-900">
                                <?php echo csrf_field(); ?>
                                <button type="submit"
                                    class="w-full text-left px-4 py-3 text-xs font-bold uppercase tracking-wider text-red-500 hover:bg-neutral-900 hover:text-red-400 transition-colors">
                                    Sign Out
                                </button>
                            </form>
                        </div>
                    </div>
                <?php else: ?>
                    <div class="flex items-center gap-3 sm:gap-4 shrink-0">
                        <a href="<?php echo e(route('subscribe')); ?>"
                            class="flex items-center gap-2 px-3 py-2 text-xs font-bold uppercase tracking-widest text-red-500 hover:text-red-400 hover:bg-neutral-900 transition-colors hidden sm:flex border border-transparent hover:border-red-600 rounded-sm">
                            <svg class="h-4 w-4 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                            </svg>
                            <span class="whitespace-nowrap">Subscribe</span>
                        </a>
                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(auth()->guard()->guest()): ?>
                            <a href="<?php echo e(route('login')); ?>" wire:navigate
                                class="flex items-center gap-2 px-4 py-2 text-xs font-bold uppercase tracking-widest text-white bg-red-600 hover:bg-red-700 transition-colors hidden sm:flex border border-red-600 rounded-sm">
                                <svg class="h-4 w-4 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1" />
                                </svg>
                                <span class="whitespace-nowrap">Sign In</span>
                            </a>
                        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                    </div>
                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
            </div>
        </div>
    </div>
</header>


<nav id="default-nav" aria-label="Main Navigation"
    class="relative z-40 transition-all duration-300 bg-white border-b border-gray-200 shadow-sm">
    <div class="px-4 mx-auto max-w-7xl sm:px-6 lg:px-8">
        <div
            class="flex items-center gap-4 py-1 overflow-x-auto text-[13px] font-bold tracking-widest text-gray-800 uppercase whitespace-nowrap sm:gap-6 lg:gap-8 md:text-sm [scrollbar-width:none] [-ms-overflow-style:none] [&::-webkit-scrollbar]:hidden overscroll-x-contain scroll-smooth">

            <div class="shrink-0 py-2">
                <?php
$__split = function ($name, $params = []) {
    return [$name, $params];
};
[$__name, $__params] = $__split('navigation.watch-live-button', []);

$__keyOuter = $__key ?? null;

$__key = null;
$__componentSlots = [];

$__key ??= \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::generateKey('lw-463825978-0', $__key);

$__html = app('livewire')->mount($__name, $__params, $__key, $__componentSlots);

echo $__html;

unset($__html);
unset($__key);
$__key = $__keyOuter;
unset($__keyOuter);
unset($__name);
unset($__params);
unset($__componentSlots);
unset($__split);
?>
            </div>

            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $pages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $page): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?>
                <?php
                    $url = $page->slug === 'home' ? route('home') : route('page.show', $page->slug);
                    $isActive = $page->slug === 'home' ? request()->is('/') : request()->is($page->slug);
                ?>

                <a href="<?php echo e($url); ?>" aria-current="<?php echo e($isActive ? 'page' : 'false'); ?>"
                    class="relative group shrink-0 py-2 outline-none focus-visible:text-red-600 transition-colors duration-200 <?php echo e($isActive ? 'text-red-600' : 'hover:text-red-600'); ?>">

                    <?php echo e($page->title); ?>


                    <span
                        class="absolute bottom-0 left-0 w-full h-[3px] bg-red-600 transform origin-left transition-transform duration-300 ease-out <?php echo e($isActive ? 'scale-x-100' : 'scale-x-0 group-hover:scale-x-100 group-focus-visible:scale-x-100'); ?>"></span>
                </a>
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
        </div>
    </div>
</nav>
<nav id="dropdown-menu"
    class="hidden bg-neutral-50 border-b border-gray-300 shadow-inner absolute w-full z-30 transition-all duration-300">
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8 py-8">
        <div
            class="grid grid-cols-2 md:grid-cols-4 lg:grid-cols-5 gap-y-6 gap-x-8 text-[13px] md:text-sm font-bold uppercase tracking-wider">
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $pages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $page): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?>
                <?php
                    $url = $page->slug === 'home' ? route('home') : route('page.show', $page->slug);
                    $isActive = $page->slug === 'home' ? request()->is('/') : request()->is($page->slug);
                ?>

                <a href="<?php echo e($url); ?>"
                    class="block text-gray-800 hover:text-red-600 border-l-[4px] border-transparent hover:border-red-600 pl-3 py-1.5 transition-all <?php echo e($isActive ? 'text-red-600 border-red-600 bg-white shadow-sm' : 'hover:bg-white hover:shadow-sm'); ?>">
                    <?php echo e($page->title); ?>

                </a>
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
        </div>
    </div>
</nav>

<?php
$__split = function ($name, $params = []) {
    return [$name, $params];
};
[$__name, $__params] = $__split('global.page-header', []);

$__keyOuter = $__key ?? null;

$__key = null;
$__componentSlots = [];

$__key ??= \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::generateKey('lw-463825978-1', $__key);

$__html = app('livewire')->mount($__name, $__params, $__key, $__componentSlots);

echo $__html;

unset($__html);
unset($__key);
$__key = $__keyOuter;
unset($__keyOuter);
unset($__name);
unset($__params);
unset($__componentSlots);
unset($__split);
?>
<?php /**PATH E:\livestream-apps\lusweti-online-center\resources\views\components\frontend\navbar.blade.php ENDPATH**/ ?>