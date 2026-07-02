<?php
if (!function_exists('_6fb2e250ac35f12e1e3ee90591b3f502')):
function _6fb2e250ac35f12e1e3ee90591b3f502($__blaze, $__data = [], $__slots = [], $__bound = [], $__keys = [], $__this = null) {
$__env = $__blaze->env;
$__slots['slot'] ??= new \Illuminate\View\ComponentSlot('');
if (($__data['attributes'] ?? null) instanceof \Illuminate\View\ComponentAttributeBag) { $__data = $__data + $__data['attributes']->all(); unset($__data['attributes']); }
extract($__slots, EXTR_SKIP); unset($__slots);
extract($__data, EXTR_SKIP);
$attributes = \Livewire\Blaze\Runtime\BlazeAttributeBag::make($__data, $__bound, $__keys);
unset($__data, $__bound, $__keys);
ob_start();
?>


<?php $tooltipPosition = $tooltipPosition ??= $attributes->pluck('tooltip:position'); ?>
<?php $tooltipKbd = $tooltipKbd ??= $attributes->pluck('tooltip:kbd'); ?>
<?php $tooltip = $tooltip ??= $attributes->pluck('tooltip'); ?>
<?php $iconTrailing ??= $attributes->pluck('icon:trailing'); ?>
<?php $iconVariant ??= $attributes->pluck('icon:variant'); ?>

<?php
$__defaults = [
    'tooltipPosition' => 'right',
    'tooltipKbd' => null,
    'tooltip' => null,
    'iconVariant' => 'outline',
    'iconTrailing' => null,
    'badgeColor' => null,
    'iconDot' => null,
    'accent' => true,
    'badge' => null,
    'icon' => null,
];
$tooltipPosition ??= $attributes['tooltip-position'] ?? $attributes['tooltipPosition'] ?? $__defaults['tooltipPosition']; unset($attributes['tooltipPosition'], $attributes['tooltip-position']);
$tooltipKbd ??= $attributes['tooltip-kbd'] ?? $attributes['tooltipKbd'] ?? $__defaults['tooltipKbd']; unset($attributes['tooltipKbd'], $attributes['tooltip-kbd']);
$tooltip ??= $attributes['tooltip'] ?? $__defaults['tooltip']; unset($attributes['tooltip']);
$iconVariant ??= $attributes['icon-variant'] ?? $attributes['iconVariant'] ?? $__defaults['iconVariant']; unset($attributes['iconVariant'], $attributes['icon-variant']);
$iconTrailing ??= $attributes['icon-trailing'] ?? $attributes['iconTrailing'] ?? $__defaults['iconTrailing']; unset($attributes['iconTrailing'], $attributes['icon-trailing']);
$badgeColor ??= $attributes['badge-color'] ?? $attributes['badgeColor'] ?? $__defaults['badgeColor']; unset($attributes['badgeColor'], $attributes['badge-color']);
$iconDot ??= $attributes['icon-dot'] ?? $attributes['iconDot'] ?? $__defaults['iconDot']; unset($attributes['iconDot'], $attributes['icon-dot']);
$accent ??= $attributes['accent'] ?? $__defaults['accent']; unset($attributes['accent']);
$badge ??= $attributes['badge'] ?? $__defaults['badge']; unset($attributes['badge']);
$icon ??= $attributes['icon'] ?? $__defaults['icon']; unset($attributes['icon']);
unset($__defaults);
?>

<?php
$tooltip ??= $slot->isNotEmpty() ? (string) $slot : null;

// Size-up icons in square/icon-only buttons...
$iconClasses = Flux::classes('size-4')
    ->add('in-data-flux-sidebar-group-dropdown:text-zinc-400! dark:in-data-flux-sidebar-group-dropdown:text-white/80!')
    ->add('[[data-flux-sidebar-item]:hover_&]:text-current!');

$classes = Flux::classes()
    ->add('h-8 in-data-flux-sidebar-on-mobile:h-10 relative flex items-center gap-3 rounded-lg')
    ->add('in-data-flux-sidebar-collapsed-desktop:w-10 in-data-flux-sidebar-collapsed-desktop:justify-center')
    ->add('py-0 text-start w-full px-3 has-data-flux-navlist-badge:not-in-data-flux-sidebar-collapsed-desktop:pe-1.5 my-px')
    ->add('text-zinc-500 dark:text-white/80')
    ->add(match ($accent) {
        true => [
            'data-current:text-(--color-accent-content) hover:data-current:text-(--color-accent-content)',
            'data-current:bg-white dark:data-current:bg-white/[7%] data-current:border data-current:border-zinc-200 dark:data-current:border-transparent',
            'hover:text-zinc-800 dark:hover:text-white dark:hover:bg-white/[7%] hover:bg-zinc-800/5 ',
            'border border-transparent',
        ],
        false => [
            'data-current:text-zinc-800 dark:data-current:text-zinc-100 data-current:border-zinc-200',
            'data-current:bg-white dark:data-current:bg-white/10 data-current:border data-current:border-zinc-200 dark:data-current:border-white/10 data-current:shadow-xs',
            'hover:text-zinc-800 dark:hover:text-white',
        ],
    })
    // Override the default styles to match dropdowns for when the item is inside a collapsed group dropdown...
    ->add('in-data-flux-sidebar-group-dropdown:w-auto! in-data-flux-sidebar-group-dropdown:px-2!')
    ->add('in-data-flux-sidebar-group-dropdown:text-zinc-800! in-data-flux-sidebar-group-dropdown:bg-white! in-data-flux-sidebar-group-dropdown:hover:bg-zinc-50!')
    ->add('dark:in-data-flux-sidebar-group-dropdown:text-white! dark:in-data-flux-sidebar-group-dropdown:bg-transparent! dark:in-data-flux-sidebar-group-dropdown:hover:bg-zinc-600!')
    ;
?>

<?php $__blaze->ensureRequired('E:\livestream-apps\lusweti-online-center\vendor\livewire\flux\src/../stubs/resources/views/flux/tooltip/index.blade.php', $__blaze->compiledPath.'/646b95bbc19f8f3f9733f4cf5a7bc4ab.php'); ?>
<?php if (isset($__slots646b95bbc19f8f3f9733f4cf5a7bc4ab)) { $__slotsStack646b95bbc19f8f3f9733f4cf5a7bc4ab[] = $__slots646b95bbc19f8f3f9733f4cf5a7bc4ab; } ?>
<?php if (isset($__attrs646b95bbc19f8f3f9733f4cf5a7bc4ab)) { $__attrsStack646b95bbc19f8f3f9733f4cf5a7bc4ab[] = $__attrs646b95bbc19f8f3f9733f4cf5a7bc4ab; } ?>
<?php $__attrs646b95bbc19f8f3f9733f4cf5a7bc4ab = ['position' => $tooltipPosition]; ?>
<?php $__slots646b95bbc19f8f3f9733f4cf5a7bc4ab = []; ?>
<?php $__blaze->pushData($__attrs646b95bbc19f8f3f9733f4cf5a7bc4ab); ?>
<?php ob_start(); ?>
    <?php $__blaze->ensureRequired('E:\livestream-apps\lusweti-online-center\vendor\livewire\flux\src/../stubs/resources/views/flux/button-or-link.blade.php', $__blaze->compiledPath.'/cb5ab22b2f801db119b9777ee05dd77e.php'); ?>
<?php if (isset($__slotscb5ab22b2f801db119b9777ee05dd77e)) { $__slotsStackcb5ab22b2f801db119b9777ee05dd77e[] = $__slotscb5ab22b2f801db119b9777ee05dd77e; } ?>
<?php if (isset($__attrscb5ab22b2f801db119b9777ee05dd77e)) { $__attrsStackcb5ab22b2f801db119b9777ee05dd77e[] = $__attrscb5ab22b2f801db119b9777ee05dd77e; } ?>
<?php $__attrscb5ab22b2f801db119b9777ee05dd77e = ['attributes' => $attributes->class($classes),'dataFluxSidebarItem' => true]; ?>
<?php $__slotscb5ab22b2f801db119b9777ee05dd77e = []; ?>
<?php $__blaze->pushData($__attrscb5ab22b2f801db119b9777ee05dd77e); ?>
<?php ob_start(); ?>
        <?php if ($icon): ?>
            <div class="relative">
                <?php if (is_string($icon) && $icon !== ''): ?>
                    <?php $blaze_memoized_key = \Livewire\Blaze\Memoizer\Memo::key("flux::icon", ['icon' => $icon, 'variant' => $iconVariant, 'class' => $iconClasses]); ?><?php if ($blaze_memoized_key !== null && \Livewire\Blaze\Memoizer\Memo::has($blaze_memoized_key)) : ?><?php echo \Livewire\Blaze\Memoizer\Memo::get($blaze_memoized_key); ?><?php else : ?><?php ob_start(); ?><?php $__blaze->ensureRequired('E:\livestream-apps\lusweti-online-center\vendor\livewire\flux\src/../stubs/resources/views/flux/icon/index.blade.php', $__blaze->compiledPath.'/674a7ecd707d55f4e7014975fe11c342.php'); ?>
<?php $__blaze->pushData(['icon' => $icon,'variant' => $iconVariant,'class' => $iconClasses]); ?>
<?php _674a7ecd707d55f4e7014975fe11c342($__blaze, ['icon' => $icon,'variant' => $iconVariant,'class' => $iconClasses], [], ['icon', 'variant'], [], $__this ?? (isset($this) ? $this : null)); ?>
<?php $__blaze->popData(); ?><?php $blaze_memoized_html = ob_get_clean(); ?><?php if ($blaze_memoized_key !== null) { \Livewire\Blaze\Memoizer\Memo::put($blaze_memoized_key, $blaze_memoized_html); } ?><?php echo $blaze_memoized_html; ?><?php endif; ?>
                <?php else: ?>
                    <?php echo e($icon); ?>

                <?php endif; ?>

                <?php if ($iconDot): ?>
                    <div class="absolute top-[-2px] end-[-2px]">
                        <div class="size-[6px] rounded-full bg-zinc-500 dark:bg-zinc-400"></div>
                    </div>
                <?php endif; ?>
            </div>
        <?php endif; ?>

        <?php if ($slot->isNotEmpty()): ?>
            <div class="
                in-data-flux-sidebar-collapsed-desktop:not-in-data-flux-sidebar-group-dropdown:hidden
                flex-1 text-sm font-medium truncate [[data-nav-footer]_&]:hidden [[data-nav-sidebar]_[data-nav-footer]_&]:block" data-content><?php echo e($slot); ?></div>
        <?php endif; ?>

        <?php if (is_string($iconTrailing) && $iconTrailing !== ''): ?>
            <?php $blaze_memoized_key = \Livewire\Blaze\Memoizer\Memo::key("flux::icon", ['icon' => $iconTrailing, 'variant' => $iconVariant, 'class' => 'in-data-flux-sidebar-collapsed-desktop:not-in-data-flux-sidebar-group-dropdown:hidden size-4!']); ?><?php if ($blaze_memoized_key !== null && \Livewire\Blaze\Memoizer\Memo::has($blaze_memoized_key)) : ?><?php echo \Livewire\Blaze\Memoizer\Memo::get($blaze_memoized_key); ?><?php else : ?><?php ob_start(); ?><?php $__blaze->ensureRequired('E:\livestream-apps\lusweti-online-center\vendor\livewire\flux\src/../stubs/resources/views/flux/icon/index.blade.php', $__blaze->compiledPath.'/674a7ecd707d55f4e7014975fe11c342.php'); ?>
<?php $__blaze->pushData(['icon' => $iconTrailing,'variant' => $iconVariant,'class' => 'in-data-flux-sidebar-collapsed-desktop:not-in-data-flux-sidebar-group-dropdown:hidden size-4!']); ?>
<?php _674a7ecd707d55f4e7014975fe11c342($__blaze, ['icon' => $iconTrailing,'variant' => $iconVariant,'class' => 'in-data-flux-sidebar-collapsed-desktop:not-in-data-flux-sidebar-group-dropdown:hidden size-4!'], [], ['icon', 'variant'], [], $__this ?? (isset($this) ? $this : null)); ?>
<?php $__blaze->popData(); ?><?php $blaze_memoized_html = ob_get_clean(); ?><?php if ($blaze_memoized_key !== null) { \Livewire\Blaze\Memoizer\Memo::put($blaze_memoized_key, $blaze_memoized_html); } ?><?php echo $blaze_memoized_html; ?><?php endif; ?>
        <?php elseif ($iconTrailing): ?>
            <?php echo e($iconTrailing); ?>

        <?php endif; ?>

        <?php if (isset($badge) && $badge !== ''): ?>
            <?php $badgeAttributes = Flux::attributesAfter('badge:', $attributes, ['color' => $badgeColor]); ?>
            <?php $__blaze->ensureRequired('E:\livestream-apps\lusweti-online-center\vendor\livewire\flux\src/../stubs/resources/views/flux/navlist/badge.blade.php', $__blaze->compiledPath.'/3835e2064df154ba3e4aaaafd9fa6d1f.php'); ?>
<?php if (isset($__slots3835e2064df154ba3e4aaaafd9fa6d1f)) { $__slotsStack3835e2064df154ba3e4aaaafd9fa6d1f[] = $__slots3835e2064df154ba3e4aaaafd9fa6d1f; } ?>
<?php if (isset($__attrs3835e2064df154ba3e4aaaafd9fa6d1f)) { $__attrsStack3835e2064df154ba3e4aaaafd9fa6d1f[] = $__attrs3835e2064df154ba3e4aaaafd9fa6d1f; } ?>
<?php $__attrs3835e2064df154ba3e4aaaafd9fa6d1f = ['attributes' => $badgeAttributes,'class' => 'in-data-flux-sidebar-collapsed-desktop:not-in-data-flux-sidebar-group-dropdown:hidden']; ?>
<?php $__slots3835e2064df154ba3e4aaaafd9fa6d1f = []; ?>
<?php $__blaze->pushData($__attrs3835e2064df154ba3e4aaaafd9fa6d1f); ?>
<?php ob_start(); ?><?php echo e($badge); ?><?php $__slots3835e2064df154ba3e4aaaafd9fa6d1f['slot'] = new \Illuminate\View\ComponentSlot(trim(ob_get_clean()), []); ?>
<?php $__blaze->pushSlots($__slots3835e2064df154ba3e4aaaafd9fa6d1f); ?>
<?php _3835e2064df154ba3e4aaaafd9fa6d1f($__blaze, $__attrs3835e2064df154ba3e4aaaafd9fa6d1f, $__slots3835e2064df154ba3e4aaaafd9fa6d1f, ['attributes'], [], $__this ?? (isset($this) ? $this : null)); ?>
<?php if (! empty($__slotsStack3835e2064df154ba3e4aaaafd9fa6d1f)) { $__slots3835e2064df154ba3e4aaaafd9fa6d1f = array_pop($__slotsStack3835e2064df154ba3e4aaaafd9fa6d1f); } ?>
<?php if (! empty($__attrsStack3835e2064df154ba3e4aaaafd9fa6d1f)) { $__attrs3835e2064df154ba3e4aaaafd9fa6d1f = array_pop($__attrsStack3835e2064df154ba3e4aaaafd9fa6d1f); } ?>
<?php $__blaze->popData(); ?>
        <?php endif; ?>
    <?php $__slotscb5ab22b2f801db119b9777ee05dd77e['slot'] = new \Illuminate\View\ComponentSlot(trim(ob_get_clean()), []); ?>
<?php $__blaze->pushSlots($__slotscb5ab22b2f801db119b9777ee05dd77e); ?>
<?php _cb5ab22b2f801db119b9777ee05dd77e($__blaze, $__attrscb5ab22b2f801db119b9777ee05dd77e, $__slotscb5ab22b2f801db119b9777ee05dd77e, ['attributes', 'dataFluxSidebarItem'], ['dataFluxSidebarItem' => 'data-flux-sidebar-item'], $__this ?? (isset($this) ? $this : null)); ?>
<?php if (! empty($__slotsStackcb5ab22b2f801db119b9777ee05dd77e)) { $__slotscb5ab22b2f801db119b9777ee05dd77e = array_pop($__slotsStackcb5ab22b2f801db119b9777ee05dd77e); } ?>
<?php if (! empty($__attrsStackcb5ab22b2f801db119b9777ee05dd77e)) { $__attrscb5ab22b2f801db119b9777ee05dd77e = array_pop($__attrsStackcb5ab22b2f801db119b9777ee05dd77e); } ?>
<?php $__blaze->popData(); ?>

    <?php $__blaze->ensureRequired('E:\livestream-apps\lusweti-online-center\vendor\livewire\flux\src/../stubs/resources/views/flux/tooltip/content.blade.php', $__blaze->compiledPath.'/cf92fc35eedf4d37517af7513850065c.php'); ?>
<?php if (isset($__slotscf92fc35eedf4d37517af7513850065c)) { $__slotsStackcf92fc35eedf4d37517af7513850065c[] = $__slotscf92fc35eedf4d37517af7513850065c; } ?>
<?php if (isset($__attrscf92fc35eedf4d37517af7513850065c)) { $__attrsStackcf92fc35eedf4d37517af7513850065c[] = $__attrscf92fc35eedf4d37517af7513850065c; } ?>
<?php $__attrscf92fc35eedf4d37517af7513850065c = ['kbd' => $tooltipKbd,'class' => 'not-in-data-flux-sidebar-collapsed-desktop:hidden in-data-flux-sidebar-group-dropdown:hidden cursor-default']; ?>
<?php $__slotscf92fc35eedf4d37517af7513850065c = []; ?>
<?php $__blaze->pushData($__attrscf92fc35eedf4d37517af7513850065c); ?>
<?php ob_start(); ?>
        <?php echo e($tooltip); ?>

    <?php $__slotscf92fc35eedf4d37517af7513850065c['slot'] = new \Illuminate\View\ComponentSlot(trim(ob_get_clean()), []); ?>
<?php $__blaze->pushSlots($__slotscf92fc35eedf4d37517af7513850065c); ?>
<?php _cf92fc35eedf4d37517af7513850065c($__blaze, $__attrscf92fc35eedf4d37517af7513850065c, $__slotscf92fc35eedf4d37517af7513850065c, ['kbd'], [], $__this ?? (isset($this) ? $this : null)); ?>
<?php if (! empty($__slotsStackcf92fc35eedf4d37517af7513850065c)) { $__slotscf92fc35eedf4d37517af7513850065c = array_pop($__slotsStackcf92fc35eedf4d37517af7513850065c); } ?>
<?php if (! empty($__attrsStackcf92fc35eedf4d37517af7513850065c)) { $__attrscf92fc35eedf4d37517af7513850065c = array_pop($__attrsStackcf92fc35eedf4d37517af7513850065c); } ?>
<?php $__blaze->popData(); ?>
<?php $__slots646b95bbc19f8f3f9733f4cf5a7bc4ab['slot'] = new \Illuminate\View\ComponentSlot(trim(ob_get_clean()), []); ?>
<?php $__blaze->pushSlots($__slots646b95bbc19f8f3f9733f4cf5a7bc4ab); ?>
<?php _646b95bbc19f8f3f9733f4cf5a7bc4ab($__blaze, $__attrs646b95bbc19f8f3f9733f4cf5a7bc4ab, $__slots646b95bbc19f8f3f9733f4cf5a7bc4ab, ['position'], [], $__this ?? (isset($this) ? $this : null)); ?>
<?php if (! empty($__slotsStack646b95bbc19f8f3f9733f4cf5a7bc4ab)) { $__slots646b95bbc19f8f3f9733f4cf5a7bc4ab = array_pop($__slotsStack646b95bbc19f8f3f9733f4cf5a7bc4ab); } ?>
<?php if (! empty($__attrsStack646b95bbc19f8f3f9733f4cf5a7bc4ab)) { $__attrs646b95bbc19f8f3f9733f4cf5a7bc4ab = array_pop($__attrsStack646b95bbc19f8f3f9733f4cf5a7bc4ab); } ?>
<?php $__blaze->popData(); ?><?php
echo ltrim(ob_get_clean());
} endif; ?><?php /**PATH E:\livestream-apps\lusweti-online-center\vendor\livewire\flux\stubs\resources\views\flux\sidebar\item.blade.php ENDPATH**/ ?>