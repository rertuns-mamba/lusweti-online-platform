<?php
if (!function_exists('__123733ec43136a63c6dd411732c457c1')):
function __123733ec43136a63c6dd411732c457c1($__blaze, $__data = [], $__slots = [], $__bound = [], $__keys = [], $__this = null) {
$__env = $__blaze->env;

if (($__data['attributes'] ?? null) instanceof \Illuminate\View\ComponentAttributeBag) { $__data = $__data + $__data['attributes']->all(); unset($__data['attributes']); }
extract($__slots, EXTR_SKIP); unset($__slots);
extract($__data, EXTR_SKIP);
$attributes = \Livewire\Blaze\Runtime\BlazeAttributeBag::make($__data, $__bound, $__keys);
unset($__data, $__bound, $__keys);
ob_start();
?>


<?php $__blaze->ensureRequired('E:\livestream-apps\lusweti-online-center\vendor\livewire\flux\src/../stubs/resources/views/flux/button/index.blade.php', $__blaze->compiledPath.'/b3ead6a1778fea5ed63abcfd97182224.php'); ?>
<?php $__blaze->pushData(['attributes' => $attributes->class('shrink-0'),'variant' => 'subtle','square' => true,'xData' => true,'xOn:click' => '$dispatch(\'flux-sidebar-toggle\')','ariaLabel' => e(__('Toggle sidebar')),'dataFluxSidebarToggle' => true]); ?>
<?php __b3ead6a1778fea5ed63abcfd97182224($__blaze, ['attributes' => $attributes->class('shrink-0'),'variant' => 'subtle','square' => true,'xData' => true,'xOn:click' => '$dispatch(\'flux-sidebar-toggle\')','ariaLabel' => e(__('Toggle sidebar')),'dataFluxSidebarToggle' => true], [], ['attributes', 'square', 'xData', 'dataFluxSidebarToggle'], ['xData' => 'x-data', 'xOn:click' => 'x-on:click', 'ariaLabel' => 'aria-label', 'dataFluxSidebarToggle' => 'data-flux-sidebar-toggle'], $__this ?? (isset($this) ? $this : null)); ?>
<?php $__blaze->popData(); ?>
<?php
echo $__blaze->processPassthroughContent('ltrim', ltrim(ob_get_clean()));
} endif; ?><?php /**PATH E:\livestream-apps\lusweti-online-center\vendor\livewire\flux\src/../stubs/resources/views/flux/sidebar/toggle.blade.php ENDPATH**/ ?>