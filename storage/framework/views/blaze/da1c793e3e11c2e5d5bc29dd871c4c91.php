<?php
if (!function_exists('__da1c793e3e11c2e5d5bc29dd871c4c91')):
function __da1c793e3e11c2e5d5bc29dd871c4c91($__blaze, $__data = [], $__slots = [], $__bound = [], $__keys = [], $__this = null) {
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
    <?php $__blaze->ensureRequired('/home/henry/Desktop/htdocs/grubinternetbanking/vendor/livewire/flux/src/../stubs/resources/views/flux/tooltip/index.blade.php', $__blaze->compiledPath.'/1677c28325f5b2e4c1307da836953e0c.php'); ?>
<?php if (isset($__slots1677c28325f5b2e4c1307da836953e0c)) { $__slotsStack1677c28325f5b2e4c1307da836953e0c[] = $__slots1677c28325f5b2e4c1307da836953e0c; } ?>
<?php if (isset($__attrs1677c28325f5b2e4c1307da836953e0c)) { $__attrsStack1677c28325f5b2e4c1307da836953e0c[] = $__attrs1677c28325f5b2e4c1307da836953e0c; } ?>
<?php $__attrs1677c28325f5b2e4c1307da836953e0c = ['content' => $tooltip,'position' => $tooltipPosition,'kbd' => $tooltipKbd]; ?>
<?php $__slots1677c28325f5b2e4c1307da836953e0c = []; ?>
<?php $__blaze->pushData($__attrs1677c28325f5b2e4c1307da836953e0c); ?>
<?php ob_start(); ?>
        <?php echo e($slot); ?>

    <?php $__slots1677c28325f5b2e4c1307da836953e0c['slot'] = new \Illuminate\View\ComponentSlot($__blaze->processPassthroughContent('trim', trim(ob_get_clean())), []); ?>
<?php $__blaze->pushSlots($__slots1677c28325f5b2e4c1307da836953e0c); ?>
<?php __1677c28325f5b2e4c1307da836953e0c($__blaze, $__attrs1677c28325f5b2e4c1307da836953e0c, $__slots1677c28325f5b2e4c1307da836953e0c, ['content', 'position', 'kbd'], [], $__this ?? (isset($this) ? $this : null)); ?>
<?php if (! empty($__slotsStack1677c28325f5b2e4c1307da836953e0c)) { $__slots1677c28325f5b2e4c1307da836953e0c = array_pop($__slotsStack1677c28325f5b2e4c1307da836953e0c); } ?>
<?php if (! empty($__attrsStack1677c28325f5b2e4c1307da836953e0c)) { $__attrs1677c28325f5b2e4c1307da836953e0c = array_pop($__attrsStack1677c28325f5b2e4c1307da836953e0c); } ?>
<?php $__blaze->popData(); ?>
<?php else: ?>
    <?php echo e($slot); ?>

<?php endif; ?>
<?php
echo $__blaze->processPassthroughContent('ltrim', ltrim(ob_get_clean()));
} endif; ?><?php /**PATH /home/henry/Desktop/htdocs/grubinternetbanking/vendor/livewire/flux/src/../stubs/resources/views/flux/with-tooltip.blade.php ENDPATH**/ ?>