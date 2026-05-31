<?php
if (!function_exists('_1677c28325f5b2e4c1307da836953e0c')):
function _1677c28325f5b2e4c1307da836953e0c($__blaze, $__data = [], $__slots = [], $__bound = [], $__keys = [], $__this = null) {
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
$__defaults = [
    'interactive' => null,
    'position' => 'top',
    'align' => 'center',
    'content' => null,
    'kbd' => null,
    'toggleable' => null,
];
$interactive ??= $attributes['interactive'] ?? $__defaults['interactive']; unset($attributes['interactive']);
$position ??= $attributes['position'] ?? $__defaults['position']; unset($attributes['position']);
$align ??= $attributes['align'] ?? $__defaults['align']; unset($attributes['align']);
$content ??= $attributes['content'] ?? $__defaults['content']; unset($attributes['content']);
$kbd ??= $attributes['kbd'] ?? $__defaults['kbd']; unset($attributes['kbd']);
$toggleable ??= $attributes['toggleable'] ?? $__defaults['toggleable']; unset($attributes['toggleable']);
unset($__defaults);
?>

<?php
// Support adding the .self modifier to the wire:model directive...
if (($wireModel = $attributes->wire('model')) && $wireModel->directive && ! $wireModel->hasModifier('self')) {
    unset($attributes[$wireModel->directive]);

    $wireModel->directive .= '.self';

    $attributes = $attributes->merge([$wireModel->directive => $wireModel->value]);
}
?>

<?php if ($toggleable): ?>
    <ui-dropdown position="<?php echo e($position); ?> <?php echo e($align); ?>" <?php echo e($attributes); ?> data-flux-tooltip>
        <?php echo e($slot); ?>


        <?php if ($content !== null): ?>
            <?php $__blaze->ensureRequired('/home/henry/Desktop/htdocs/grubinternetbanking/vendor/livewire/flux/src/../stubs/resources/views/flux/tooltip/content.blade.php', $__blaze->compiledPath.'/a3135de46300f669a9a8e42bedbaf8ae.php'); ?>
<?php if (isset($__slotsa3135de46300f669a9a8e42bedbaf8ae)) { $__slotsStacka3135de46300f669a9a8e42bedbaf8ae[] = $__slotsa3135de46300f669a9a8e42bedbaf8ae; } ?>
<?php if (isset($__attrsa3135de46300f669a9a8e42bedbaf8ae)) { $__attrsStacka3135de46300f669a9a8e42bedbaf8ae[] = $__attrsa3135de46300f669a9a8e42bedbaf8ae; } ?>
<?php $__attrsa3135de46300f669a9a8e42bedbaf8ae = ['kbd' => $kbd]; ?>
<?php $__slotsa3135de46300f669a9a8e42bedbaf8ae = []; ?>
<?php $__blaze->pushData($__attrsa3135de46300f669a9a8e42bedbaf8ae); ?>
<?php ob_start(); ?><?php echo e($content); ?><?php $__slotsa3135de46300f669a9a8e42bedbaf8ae['slot'] = new \Illuminate\View\ComponentSlot(trim(ob_get_clean()), []); ?>
<?php $__blaze->pushSlots($__slotsa3135de46300f669a9a8e42bedbaf8ae); ?>
<?php _a3135de46300f669a9a8e42bedbaf8ae($__blaze, $__attrsa3135de46300f669a9a8e42bedbaf8ae, $__slotsa3135de46300f669a9a8e42bedbaf8ae, ['kbd'], [], $__this ?? (isset($this) ? $this : null)); ?>
<?php if (! empty($__slotsStacka3135de46300f669a9a8e42bedbaf8ae)) { $__slotsa3135de46300f669a9a8e42bedbaf8ae = array_pop($__slotsStacka3135de46300f669a9a8e42bedbaf8ae); } ?>
<?php if (! empty($__attrsStacka3135de46300f669a9a8e42bedbaf8ae)) { $__attrsa3135de46300f669a9a8e42bedbaf8ae = array_pop($__attrsStacka3135de46300f669a9a8e42bedbaf8ae); } ?>
<?php $__blaze->popData(); ?>
        <?php endif; ?>
    </ui-dropdown>
<?php else: ?>
    <ui-tooltip position="<?php echo e($position); ?> <?php echo e($align); ?>" <?php echo e($attributes); ?> data-flux-tooltip <?php if($interactive): ?> interactive <?php endif; ?>>
        <?php echo e($slot); ?>


        <?php if ($content !== null): ?>
            <?php $__blaze->ensureRequired('/home/henry/Desktop/htdocs/grubinternetbanking/vendor/livewire/flux/src/../stubs/resources/views/flux/tooltip/content.blade.php', $__blaze->compiledPath.'/a3135de46300f669a9a8e42bedbaf8ae.php'); ?>
<?php if (isset($__slotsa3135de46300f669a9a8e42bedbaf8ae)) { $__slotsStacka3135de46300f669a9a8e42bedbaf8ae[] = $__slotsa3135de46300f669a9a8e42bedbaf8ae; } ?>
<?php if (isset($__attrsa3135de46300f669a9a8e42bedbaf8ae)) { $__attrsStacka3135de46300f669a9a8e42bedbaf8ae[] = $__attrsa3135de46300f669a9a8e42bedbaf8ae; } ?>
<?php $__attrsa3135de46300f669a9a8e42bedbaf8ae = ['kbd' => $kbd]; ?>
<?php $__slotsa3135de46300f669a9a8e42bedbaf8ae = []; ?>
<?php $__blaze->pushData($__attrsa3135de46300f669a9a8e42bedbaf8ae); ?>
<?php ob_start(); ?><?php echo e($content); ?><?php $__slotsa3135de46300f669a9a8e42bedbaf8ae['slot'] = new \Illuminate\View\ComponentSlot(trim(ob_get_clean()), []); ?>
<?php $__blaze->pushSlots($__slotsa3135de46300f669a9a8e42bedbaf8ae); ?>
<?php _a3135de46300f669a9a8e42bedbaf8ae($__blaze, $__attrsa3135de46300f669a9a8e42bedbaf8ae, $__slotsa3135de46300f669a9a8e42bedbaf8ae, ['kbd'], [], $__this ?? (isset($this) ? $this : null)); ?>
<?php if (! empty($__slotsStacka3135de46300f669a9a8e42bedbaf8ae)) { $__slotsa3135de46300f669a9a8e42bedbaf8ae = array_pop($__slotsStacka3135de46300f669a9a8e42bedbaf8ae); } ?>
<?php if (! empty($__attrsStacka3135de46300f669a9a8e42bedbaf8ae)) { $__attrsa3135de46300f669a9a8e42bedbaf8ae = array_pop($__attrsStacka3135de46300f669a9a8e42bedbaf8ae); } ?>
<?php $__blaze->popData(); ?>
        <?php endif; ?>
    </ui-tooltip>
<?php endif; ?>
<?php
echo ltrim(ob_get_clean());
} endif; ?><?php /**PATH /home/henry/Desktop/htdocs/grubinternetbanking/vendor/livewire/flux/src/../stubs/resources/views/flux/tooltip/index.blade.php ENDPATH**/ ?>