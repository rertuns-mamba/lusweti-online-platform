<?php
if (!function_exists('_81e529cb80b1330e8cb3e394867b9ab8')):
function _81e529cb80b1330e8cb3e394867b9ab8($__blaze, $__data = [], $__slots = [], $__bound = [], $__keys = [], $__this = null) {
$__env = $__blaze->env;
$__slots['slot'] ??= new \Illuminate\View\ComponentSlot('');
if (($__data['attributes'] ?? null) instanceof \Illuminate\View\ComponentAttributeBag) { $__data = $__data + $__data['attributes']->all(); unset($__data['attributes']); }
extract($__slots, EXTR_SKIP); unset($__slots);
extract($__data, EXTR_SKIP);
$attributes = \Livewire\Blaze\Runtime\BlazeAttributeBag::make($__data, $__bound, $__keys);
unset($__data, $__bound, $__keys);
ob_start();
?>


<?php
extract(Flux::forwardedAttributes($attributes, [
    'tooltipPosition',
    'tooltipKbd',
    'tooltip',
]));
?>

<?php $tooltipPosition = $tooltipPosition ??= $attributes->pluck('tooltip:position'); ?>
<?php $tooltipKbd = $tooltipKbd ??= $attributes->pluck('tooltip:kbd'); ?>
<?php $tooltip = $tooltip ??= $attributes->pluck('tooltip'); ?>

<?php
$__defaults = [
    'tooltipPosition' => 'top',
    'tooltipKbd' => null,
    'tooltip' => null,
];
$tooltipPosition ??= $attributes['tooltip-position'] ?? $attributes['tooltipPosition'] ?? $__defaults['tooltipPosition']; unset($attributes['tooltipPosition'], $attributes['tooltip-position']);
$tooltipKbd ??= $attributes['tooltip-kbd'] ?? $attributes['tooltipKbd'] ?? $__defaults['tooltipKbd']; unset($attributes['tooltipKbd'], $attributes['tooltip-kbd']);
$tooltip ??= $attributes['tooltip'] ?? $__defaults['tooltip']; unset($attributes['tooltip']);
unset($__defaults);
?>

<?php if ($tooltip): ?>
    <?php $__blaze->ensureRequired('E:\livestream-apps\lusweti-online-center\vendor\livewire\flux\src/../stubs/resources/views/flux/tooltip/index.blade.php', $__blaze->compiledPath.'/646b95bbc19f8f3f9733f4cf5a7bc4ab.php'); ?>
<?php if (isset($__slots646b95bbc19f8f3f9733f4cf5a7bc4ab)) { $__slotsStack646b95bbc19f8f3f9733f4cf5a7bc4ab[] = $__slots646b95bbc19f8f3f9733f4cf5a7bc4ab; } ?>
<?php if (isset($__attrs646b95bbc19f8f3f9733f4cf5a7bc4ab)) { $__attrsStack646b95bbc19f8f3f9733f4cf5a7bc4ab[] = $__attrs646b95bbc19f8f3f9733f4cf5a7bc4ab; } ?>
<?php $__attrs646b95bbc19f8f3f9733f4cf5a7bc4ab = ['content' => $tooltip,'position' => $tooltipPosition,'kbd' => $tooltipKbd]; ?>
<?php $__slots646b95bbc19f8f3f9733f4cf5a7bc4ab = []; ?>
<?php $__blaze->pushData($__attrs646b95bbc19f8f3f9733f4cf5a7bc4ab); ?>
<?php ob_start(); ?>
        <?php echo e($slot); ?>

    <?php $__slots646b95bbc19f8f3f9733f4cf5a7bc4ab['slot'] = new \Illuminate\View\ComponentSlot(trim(ob_get_clean()), []); ?>
<?php $__blaze->pushSlots($__slots646b95bbc19f8f3f9733f4cf5a7bc4ab); ?>
<?php _646b95bbc19f8f3f9733f4cf5a7bc4ab($__blaze, $__attrs646b95bbc19f8f3f9733f4cf5a7bc4ab, $__slots646b95bbc19f8f3f9733f4cf5a7bc4ab, ['content', 'position', 'kbd'], [], $__this ?? (isset($this) ? $this : null)); ?>
<?php if (! empty($__slotsStack646b95bbc19f8f3f9733f4cf5a7bc4ab)) { $__slots646b95bbc19f8f3f9733f4cf5a7bc4ab = array_pop($__slotsStack646b95bbc19f8f3f9733f4cf5a7bc4ab); } ?>
<?php if (! empty($__attrsStack646b95bbc19f8f3f9733f4cf5a7bc4ab)) { $__attrs646b95bbc19f8f3f9733f4cf5a7bc4ab = array_pop($__attrsStack646b95bbc19f8f3f9733f4cf5a7bc4ab); } ?>
<?php $__blaze->popData(); ?>
<?php else: ?>
    <?php echo e($slot); ?>

<?php endif; ?>
<?php
echo ltrim(ob_get_clean());
} endif; ?><?php /**PATH E:\livestream-apps\lusweti-online-center\vendor\livewire\flux\stubs\resources\views\flux\with-tooltip.blade.php ENDPATH**/ ?>