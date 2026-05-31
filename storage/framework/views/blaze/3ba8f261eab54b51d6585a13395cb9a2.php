<?php
if (!function_exists('__3ba8f261eab54b51d6585a13395cb9a2')):
function __3ba8f261eab54b51d6585a13395cb9a2($__blaze, $__data = [], $__slots = [], $__bound = [], $__keys = [], $__this = null) {
$__env = $__blaze->env;
$__slots['slot'] ??= new \Illuminate\View\ComponentSlot('');
if (($__data['attributes'] ?? null) instanceof \Illuminate\View\ComponentAttributeBag) { $__data = $__data + $__data['attributes']->all(); unset($__data['attributes']); }
extract($__slots, EXTR_SKIP); unset($__slots);
extract($__data, EXTR_SKIP);
$attributes = \Livewire\Blaze\Runtime\BlazeAttributeBag::make($__data, $__bound, $__keys);
unset($__data, $__bound, $__keys);
ob_start();
?>


<tbody <?php echo e($attributes); ?> data-flux-rows>
    <?php echo e($slot); ?>

</tbody>
<?php
echo $__blaze->processPassthroughContent('ltrim', ltrim(ob_get_clean()));
} endif; ?><?php /**PATH /home/henry/Desktop/htdocs/grubinternetbanking/vendor/livewire/flux/src/../stubs/resources/views/flux/table/rows.blade.php ENDPATH**/ ?>