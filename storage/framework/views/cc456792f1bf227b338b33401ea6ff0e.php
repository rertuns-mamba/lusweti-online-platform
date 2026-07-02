<?php
if (!function_exists('_cc456792f1bf227b338b33401ea6ff0e')):
function _cc456792f1bf227b338b33401ea6ff0e($__blaze, $__data = [], $__slots = [], $__bound = [], $__keys = [], $__this = null) {
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
    'class' => '-me-1',
    'square' => true,
    'size' => null,
]);
?>

<?php $__blaze->ensureRequired('E:\livestream-apps\lusweti-online-center\vendor\livewire\flux\src/../stubs/resources/views/flux/button/index.blade.php', $__blaze->compiledPath.'/b3ead6a1778fea5ed63abcfd97182224.php'); ?>
<?php if (isset($__slotsb3ead6a1778fea5ed63abcfd97182224)) { $__slotsStackb3ead6a1778fea5ed63abcfd97182224[] = $__slotsb3ead6a1778fea5ed63abcfd97182224; } ?>
<?php if (isset($__attrsb3ead6a1778fea5ed63abcfd97182224)) { $__attrsStackb3ead6a1778fea5ed63abcfd97182224[] = $__attrsb3ead6a1778fea5ed63abcfd97182224; } ?>
<?php $__attrsb3ead6a1778fea5ed63abcfd97182224 = ['attributes' => $attributes,'size' => $size === 'sm' || $size === 'xs' ? 'xs' : 'sm','xData' => 'fluxInputCopyable','xOn:click' => 'copy()','xBind:dataCopyableCopied' => 'copied','ariaLabel' => e(__('Copy to clipboard'))]; ?>
<?php $__slotsb3ead6a1778fea5ed63abcfd97182224 = []; ?>
<?php $__blaze->pushData($__attrsb3ead6a1778fea5ed63abcfd97182224); ?>
<?php ob_start(); ?>
    <?php $__blaze->ensureRequired('E:\livestream-apps\lusweti-online-center\vendor\livewire\flux\src/../stubs/resources/views/flux/icon/clipboard-document-check.blade.php', $__blaze->compiledPath.'/b1b97d3a215501c2ce1ff78536aa912d.php'); ?>
<?php $__blaze->pushData(['variant' => $iconVariant,'class' => 'hidden [[data-copyable-copied]>&]:block']); ?>
<?php _b1b97d3a215501c2ce1ff78536aa912d($__blaze, ['variant' => $iconVariant,'class' => 'hidden [[data-copyable-copied]>&]:block'], [], ['variant'], [], $__this ?? (isset($this) ? $this : null)); ?>
<?php $__blaze->popData(); ?>
    <?php $__blaze->ensureRequired('E:\livestream-apps\lusweti-online-center\vendor\livewire\flux\src/../stubs/resources/views/flux/icon/clipboard-document.blade.php', $__blaze->compiledPath.'/554bc234db99e886df0d6b9ea3e89e4a.php'); ?>
<?php $__blaze->pushData(['variant' => $iconVariant,'class' => 'block [[data-copyable-copied]>&]:hidden']); ?>
<?php _554bc234db99e886df0d6b9ea3e89e4a($__blaze, ['variant' => $iconVariant,'class' => 'block [[data-copyable-copied]>&]:hidden'], [], ['variant'], [], $__this ?? (isset($this) ? $this : null)); ?>
<?php $__blaze->popData(); ?>
<?php $__slotsb3ead6a1778fea5ed63abcfd97182224['slot'] = new \Illuminate\View\ComponentSlot(trim(ob_get_clean()), []); ?>
<?php $__blaze->pushSlots($__slotsb3ead6a1778fea5ed63abcfd97182224); ?>
<?php _b3ead6a1778fea5ed63abcfd97182224($__blaze, $__attrsb3ead6a1778fea5ed63abcfd97182224, $__slotsb3ead6a1778fea5ed63abcfd97182224, ['attributes', 'size'], ['xData' => 'x-data', 'xOn:click' => 'x-on:click', 'xBind:dataCopyableCopied' => 'x-bind:data-copyable-copied', 'ariaLabel' => 'aria-label'], $__this ?? (isset($this) ? $this : null)); ?>
<?php if (! empty($__slotsStackb3ead6a1778fea5ed63abcfd97182224)) { $__slotsb3ead6a1778fea5ed63abcfd97182224 = array_pop($__slotsStackb3ead6a1778fea5ed63abcfd97182224); } ?>
<?php if (! empty($__attrsStackb3ead6a1778fea5ed63abcfd97182224)) { $__attrsb3ead6a1778fea5ed63abcfd97182224 = array_pop($__attrsStackb3ead6a1778fea5ed63abcfd97182224); } ?>
<?php $__blaze->popData(); ?>
<?php
echo ltrim(ob_get_clean());
} endif; ?><?php /**PATH E:\livestream-apps\lusweti-online-center\vendor\livewire\flux\stubs\resources\views\flux\input\copyable.blade.php ENDPATH**/ ?>