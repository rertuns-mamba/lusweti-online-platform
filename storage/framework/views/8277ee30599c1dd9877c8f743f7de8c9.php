<?php
if (!function_exists('_8277ee30599c1dd9877c8f743f7de8c9')):
function _8277ee30599c1dd9877c8f743f7de8c9($__blaze, $__data = [], $__slots = [], $__bound = [], $__keys = [], $__this = null) {
$__env = $__blaze->env;

if (($__data['attributes'] ?? null) instanceof \Illuminate\View\ComponentAttributeBag) { $__data = $__data + $__data['attributes']->all(); unset($__data['attributes']); }
extract($__slots, EXTR_SKIP); unset($__slots);
extract($__data, EXTR_SKIP);
$attributes = \Livewire\Blaze\Runtime\BlazeAttributeBag::make($__data, $__bound, $__keys);
unset($__data, $__bound, $__keys);
ob_start();
?>


<?php
$__defaults = [
    'iconVariant' => 'mini',
    'size' => null,
];
$iconVariant ??= $attributes['icon-variant'] ?? $attributes['iconVariant'] ?? $__defaults['iconVariant']; unset($attributes['iconVariant'], $attributes['icon-variant']);
$size ??= $attributes['size'] ?? $__defaults['size']; unset($attributes['size']);
unset($__defaults);
?>

<?php
$attributes = $attributes->merge([
    'variant' => 'subtle',
    'class' => '-me-1 [[data-flux-input]:has(input:placeholder-shown)_&]:hidden [[data-flux-input]:has(input[disabled])_&]:hidden',
    'square' => true,
    'size' => null,
]);
?>

<?php $__blaze->ensureRequired('E:\livestream-apps\lusweti-online-center\vendor\livewire\flux\src/../stubs/resources/views/flux/button/index.blade.php', $__blaze->compiledPath.'/b3ead6a1778fea5ed63abcfd97182224.php'); ?>
<?php if (isset($__slotsb3ead6a1778fea5ed63abcfd97182224)) { $__slotsStackb3ead6a1778fea5ed63abcfd97182224[] = $__slotsb3ead6a1778fea5ed63abcfd97182224; } ?>
<?php if (isset($__attrsb3ead6a1778fea5ed63abcfd97182224)) { $__attrsStackb3ead6a1778fea5ed63abcfd97182224[] = $__attrsb3ead6a1778fea5ed63abcfd97182224; } ?>
<?php $__attrsb3ead6a1778fea5ed63abcfd97182224 = ['attributes' => $attributes,'size' => $size === 'sm' || $size === 'xs' ? 'xs' : 'sm','xData' => 'fluxInputClearable','xOn:click' => 'clear()','tabindex' => '-1','ariaLabel' => e(__('Clear input')),'dataFluxClearButton' => true]; ?>
<?php $__slotsb3ead6a1778fea5ed63abcfd97182224 = []; ?>
<?php $__blaze->pushData($__attrsb3ead6a1778fea5ed63abcfd97182224); ?>
<?php ob_start(); ?>
    <?php $__blaze->ensureRequired('E:\livestream-apps\lusweti-online-center\vendor\livewire\flux\src/../stubs/resources/views/flux/icon/x-mark.blade.php', $__blaze->compiledPath.'/24c857753d6f5dbae7f39da3ce819dad.php'); ?>
<?php $__blaze->pushData(['variant' => $iconVariant]); ?>
<?php _24c857753d6f5dbae7f39da3ce819dad($__blaze, ['variant' => $iconVariant], [], ['variant'], [], $__this ?? (isset($this) ? $this : null)); ?>
<?php $__blaze->popData(); ?>
<?php $__slotsb3ead6a1778fea5ed63abcfd97182224['slot'] = new \Illuminate\View\ComponentSlot(trim(ob_get_clean()), []); ?>
<?php $__blaze->pushSlots($__slotsb3ead6a1778fea5ed63abcfd97182224); ?>
<?php _b3ead6a1778fea5ed63abcfd97182224($__blaze, $__attrsb3ead6a1778fea5ed63abcfd97182224, $__slotsb3ead6a1778fea5ed63abcfd97182224, ['attributes', 'size', 'dataFluxClearButton'], ['xData' => 'x-data', 'xOn:click' => 'x-on:click', 'ariaLabel' => 'aria-label', 'dataFluxClearButton' => 'data-flux-clear-button'], $__this ?? (isset($this) ? $this : null)); ?>
<?php if (! empty($__slotsStackb3ead6a1778fea5ed63abcfd97182224)) { $__slotsb3ead6a1778fea5ed63abcfd97182224 = array_pop($__slotsStackb3ead6a1778fea5ed63abcfd97182224); } ?>
<?php if (! empty($__attrsStackb3ead6a1778fea5ed63abcfd97182224)) { $__attrsb3ead6a1778fea5ed63abcfd97182224 = array_pop($__attrsStackb3ead6a1778fea5ed63abcfd97182224); } ?>
<?php $__blaze->popData(); ?>
<?php
echo ltrim(ob_get_clean());
} endif; ?><?php /**PATH E:\livestream-apps\lusweti-online-center\vendor\livewire\flux\stubs\resources\views\flux\input\clearable.blade.php ENDPATH**/ ?>