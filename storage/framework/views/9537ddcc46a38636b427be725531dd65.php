<header x-data="{ mobileMenuOpen: false, accountMenuOpen: false }" class="sticky top-0 z-50 w-full bg-white font-sans border-b border-gray-200">
    
    
    <div class="max-w-7xl mx-auto relative z-40 bg-white">
        <div class="flex h-14 sm:h-16 items-center justify-between border-b border-gray-100">
            
            
            <div class="flex items-center gap-4">
                <?php echo $__env->make('partials.site-header.mobile-toggle', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
            </div>

            
            <div class="flex-shrink-0">
                <a href="/" wire:navigate><img src="/logo.png" class="h-8"></a>
            </div>

            
            <div class="flex items-center h-full">
                <?php
$__split = function ($name, $params = []) {
    return [$name, $params];
};
[$__name, $__params] = $__split('frontend.navbar-actions', []);

$__keyOuter = $__key ?? null;

$__key = null;
$__componentSlots = [];

$__key ??= \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::generateKey('lw-2957981164-0', $__key);

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
        </div>
    </div>

    
    <nav class="border-b border-gray-100 bg-gray-100">
        <div class="max-w-7xl mx-auto">
            <?php
$__split = function ($name, $params = []) {
    return [$name, $params];
};
[$__name, $__params] = $__split('frontend.header-navigation', []);

$__keyOuter = $__key ?? null;

$__key = null;
$__componentSlots = [];

$__key ??= \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::generateKey('lw-2957981164-1', $__key);

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
    </nav>

    <?php
$__split = function ($name, $params = []) {
    return [$name, $params];
};
[$__name, $__params] = $__split('frontend.breaking-news', []);

$__keyOuter = $__key ?? null;

$__key = null;
$__componentSlots = [];

$__key ??= \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::generateKey('lw-2957981164-2', $__key);

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
</header><?php /**PATH E:\livestream-apps\lusweti-online-center\resources\views\livewire\sections\master-header.blade.php ENDPATH**/ ?>