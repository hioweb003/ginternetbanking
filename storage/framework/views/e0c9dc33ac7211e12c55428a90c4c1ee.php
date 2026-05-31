<?php # [BlazeFolded]:{flux::heading}:{/home/henry/Desktop/htdocs/grubinternetbanking/vendor/livewire/flux/src/../stubs/resources/views/flux/heading.blade.php}:{1776985208} ?>
<?php # [BlazeFolded]:{flux::separator}:{/home/henry/Desktop/htdocs/grubinternetbanking/vendor/livewire/flux/src/../stubs/resources/views/flux/separator.blade.php}:{1776985208} ?>
<?php # [BlazeFolded]:{flux::table.column}:{/home/henry/Desktop/htdocs/grubinternetbanking/vendor/livewire/flux/src/../stubs/resources/views/flux/table/column.blade.php}:{1776985208} ?>
<?php # [BlazeFolded]:{flux::table.column}:{/home/henry/Desktop/htdocs/grubinternetbanking/vendor/livewire/flux/src/../stubs/resources/views/flux/table/column.blade.php}:{1776985208} ?>
<?php # [BlazeFolded]:{flux::table.column}:{/home/henry/Desktop/htdocs/grubinternetbanking/vendor/livewire/flux/src/../stubs/resources/views/flux/table/column.blade.php}:{1776985208} ?>
<?php # [BlazeFolded]:{flux::table.column}:{/home/henry/Desktop/htdocs/grubinternetbanking/vendor/livewire/flux/src/../stubs/resources/views/flux/table/column.blade.php}:{1776985208} ?>
<?php # [BlazeFolded]:{flux::table.column}:{/home/henry/Desktop/htdocs/grubinternetbanking/vendor/livewire/flux/src/../stubs/resources/views/flux/table/column.blade.php}:{1776985208} ?>
<?php # [BlazeFolded]:{flux::table.column}:{/home/henry/Desktop/htdocs/grubinternetbanking/vendor/livewire/flux/src/../stubs/resources/views/flux/table/column.blade.php}:{1776985208} ?>
<?php # [BlazeFolded]:{flux::table.columns}:{/home/henry/Desktop/htdocs/grubinternetbanking/vendor/livewire/flux/src/../stubs/resources/views/flux/table/columns.blade.php}:{1776985208} ?>
<?php # [BlazeFolded]:{flux::table.cell}:{/home/henry/Desktop/htdocs/grubinternetbanking/vendor/livewire/flux/src/../stubs/resources/views/flux/table/cell.blade.php}:{1776985208} ?>
<?php # [BlazeFolded]:{flux::table.cell}:{/home/henry/Desktop/htdocs/grubinternetbanking/vendor/livewire/flux/src/../stubs/resources/views/flux/table/cell.blade.php}:{1776985208} ?>
<?php # [BlazeFolded]:{flux::table.cell}:{/home/henry/Desktop/htdocs/grubinternetbanking/vendor/livewire/flux/src/../stubs/resources/views/flux/table/cell.blade.php}:{1776985208} ?>
<?php # [BlazeFolded]:{flux::table.cell}:{/home/henry/Desktop/htdocs/grubinternetbanking/vendor/livewire/flux/src/../stubs/resources/views/flux/table/cell.blade.php}:{1776985208} ?>
<?php # [BlazeFolded]:{flux::text}:{/home/henry/Desktop/htdocs/grubinternetbanking/vendor/livewire/flux/src/../stubs/resources/views/flux/text.blade.php}:{1776985208} ?>
<?php # [BlazeFolded]:{flux::table.cell}:{/home/henry/Desktop/htdocs/grubinternetbanking/vendor/livewire/flux/src/../stubs/resources/views/flux/table/cell.blade.php}:{1776985208} ?>
<?php # [BlazeFolded]:{flux::button}:{/home/henry/Desktop/htdocs/grubinternetbanking/vendor/livewire/flux/src/../stubs/resources/views/flux/button/index.blade.php}:{1776985208} ?>
<?php # [BlazeFolded]:{flux::menu.item}:{/home/henry/Desktop/htdocs/grubinternetbanking/vendor/livewire/flux/src/../stubs/resources/views/flux/menu/item.blade.php}:{1776985208} ?>
<?php # [BlazeFolded]:{flux::tooltip}:{/home/henry/Desktop/htdocs/grubinternetbanking/vendor/livewire/flux/src/../stubs/resources/views/flux/tooltip/index.blade.php}:{1776985208} ?>
<?php # [BlazeFolded]:{flux::tooltip}:{/home/henry/Desktop/htdocs/grubinternetbanking/vendor/livewire/flux/src/../stubs/resources/views/flux/tooltip/index.blade.php}:{1776985208} ?>
<?php # [BlazeFolded]:{flux::menu}:{/home/henry/Desktop/htdocs/grubinternetbanking/vendor/livewire/flux/src/../stubs/resources/views/flux/menu/index.blade.php}:{1776985208} ?>
<?php # [BlazeFolded]:{flux::dropdown}:{/home/henry/Desktop/htdocs/grubinternetbanking/vendor/livewire/flux/src/../stubs/resources/views/flux/dropdown.blade.php}:{1776985208} ?>
<?php # [BlazeFolded]:{flux::table.cell}:{/home/henry/Desktop/htdocs/grubinternetbanking/vendor/livewire/flux/src/../stubs/resources/views/flux/table/cell.blade.php}:{1776985208} ?>
<?php # [BlazeFolded]:{flux::table.row}:{/home/henry/Desktop/htdocs/grubinternetbanking/vendor/livewire/flux/src/../stubs/resources/views/flux/table/row.blade.php}:{1776985208} ?>
<?php # [BlazeFolded]:{flux::table.rows}:{/home/henry/Desktop/htdocs/grubinternetbanking/vendor/livewire/flux/src/../stubs/resources/views/flux/table/rows.blade.php}:{1776985208} ?>
<?php # [BlazeFolded]:{flux::table}:{/home/henry/Desktop/htdocs/grubinternetbanking/vendor/livewire/flux/src/../stubs/resources/views/flux/table/index.blade.php}:{1776985208} ?>
<?php
use Livewire\Component;
use Livewire\Attributes\Layout;
use \Livewire\WithPagination;
use \App\Models\Institution;
use Livewire\Attributes\Computed;
?>

<div>
     <?php ob_start(); ?><h1 class="font-medium [:where(&amp;)]:text-zinc-800 [:where(&amp;)]:dark:text-white text-2xl [&amp;:has(+[data-flux-subheading])]:mb-2 [[data-flux-subheading]+&amp;]:mt-2" data-flux-heading><?php ob_start(); ?>Dashboard<?php echo trim(ob_get_clean()); ?></h1>

        <?php echo ltrim(ob_get_clean()); ?>

        

        <?php ob_start(); ?><div data-orientation="horizontal" role="none" class="border-0 [print-color-adjust:exact] bg-zinc-800/5 dark:bg-white/10 h-px w-full mb-20" data-flux-separator></div>
<?php echo ltrim(ob_get_clean()); ?>

        <?php ob_start(); ?><div class="flex flex-col ">
    

    <ui-table-scroll-area class="overflow-auto">
        <table class="[:where(&amp;)]:min-w-full table-fixed border-separate border-spacing-0 isolate text-zinc-800 whitespace-nowrap [&amp;_dialog]:whitespace-normal [&amp;_[popover]]:whitespace-normal" data-flux-table>
            <?php ob_start(); ?>
            <?php ob_start(); ?><thead class="" data-flux-columns>
    <tr >
        <?php ob_start(); ?>
                <?php ob_start(); ?><th class="py-3 px-3 first:ps-0 last:pe-0 text-start text-sm font-medium text-zinc-800 dark:text-white border-b border-zinc-800/10 dark:border-white/20    **:data-flux-table-sortable:last:me-0 max-md:hidden" data-flux-column>
            <div class="flex in-[.group\/center-align]:justify-center in-[.group\/end-align]:justify-end"><?php ob_start(); ?>ID<?php echo trim(ob_get_clean()); ?></div>
    </th>
<?php echo ltrim(ob_get_clean()); ?>
                <?php ob_start(); ?><th class="py-3 px-3 first:ps-0 last:pe-0 text-start text-sm font-medium text-zinc-800 dark:text-white border-b border-zinc-800/10 dark:border-white/20    **:data-flux-table-sortable:last:me-0 max-md:hidden" data-flux-column>
            <div class="flex in-[.group\/center-align]:justify-center in-[.group\/end-align]:justify-end"><?php ob_start(); ?>Date<?php echo trim(ob_get_clean()); ?></div>
    </th>
<?php echo ltrim(ob_get_clean()); ?>
                <?php ob_start(); ?><th class="py-3 px-3 first:ps-0 last:pe-0 text-start text-sm font-medium text-zinc-800 dark:text-white border-b border-zinc-800/10 dark:border-white/20    **:data-flux-table-sortable:last:me-0 max-md:hidden" data-flux-column>
            <div class="flex in-[.group\/center-align]:justify-center in-[.group\/end-align]:justify-end"><?php ob_start(); ?>Institution Name<?php echo trim(ob_get_clean()); ?></div>
    </th>
<?php echo ltrim(ob_get_clean()); ?>
                <?php ob_start(); ?><th class="py-3 px-3 first:ps-0 last:pe-0 text-start text-sm font-medium text-zinc-800 dark:text-white border-b border-zinc-800/10 dark:border-white/20    **:data-flux-table-sortable:last:me-0 max-md:hidden" data-flux-column>
            <div class="flex in-[.group\/center-align]:justify-center in-[.group\/end-align]:justify-end"><?php ob_start(); ?>Logo<?php echo trim(ob_get_clean()); ?></div>
    </th>
<?php echo ltrim(ob_get_clean()); ?>
                <?php ob_start(); ?><th class="py-3 px-3 first:ps-0 last:pe-0 text-start text-sm font-medium text-zinc-800 dark:text-white border-b border-zinc-800/10 dark:border-white/20    **:data-flux-table-sortable:last:me-0 max-md:hidden" data-flux-column>
            <div class="flex in-[.group\/center-align]:justify-center in-[.group\/end-align]:justify-end"><?php ob_start(); ?>Status<?php echo trim(ob_get_clean()); ?></div>
    </th>
<?php echo ltrim(ob_get_clean()); ?>
                <?php ob_start(); ?><th class="py-3 px-3 first:ps-0 last:pe-0 text-start text-sm font-medium text-zinc-800 dark:text-white border-b border-zinc-800/10 dark:border-white/20    **:data-flux-table-sortable:last:me-0" data-flux-column>
            <div class="flex in-[.group\/center-align]:justify-center in-[.group\/end-align]:justify-end"></div>
    </th>
<?php echo ltrim(ob_get_clean()); ?>
            <?php echo trim(ob_get_clean()); ?>

    </tr>
</thead>
<?php echo ltrim(ob_get_clean()); ?>

            <?php ob_start(); ?><tbody  data-flux-rows>
    <?php ob_start(); ?>
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $this->GetInstitution(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?>
                    <?php ob_start(); ?><tr  class="" data-flux-row>
    <?php ob_start(); ?>
                        <?php ob_start(); ?><td class="py-3 px-3 first:ps-0 last:pe-0 text-sm  text-zinc-500 dark:text-zinc-300  not-in-[tr:first-child]:border-t border-zinc-800/10 dark:border-white/20 max-md:hidden" data-flux-cell>
    <?php ob_start(); ?>#<?php echo e($row->code); ?><?php echo trim(ob_get_clean()); ?>

</td>
<?php echo ltrim(ob_get_clean()); ?>
                        <?php ob_start(); ?><td class="py-3 px-3 first:ps-0 last:pe-0 text-sm  text-zinc-500 dark:text-zinc-300  not-in-[tr:first-child]:border-t border-zinc-800/10 dark:border-white/20 max-md:hidden" data-flux-cell>
    <?php ob_start(); ?><?php echo e(date('d-m-Y H:ia',strtotime($row->created_at))); ?><?php echo trim(ob_get_clean()); ?>

</td>
<?php echo ltrim(ob_get_clean()); ?>
                        <?php ob_start(); ?><td class="py-3 px-3 first:ps-0 last:pe-0 text-sm  text-zinc-500 dark:text-zinc-300  not-in-[tr:first-child]:border-t border-zinc-800/10 dark:border-white/20 max-md:hidden" data-flux-cell>
    <?php ob_start(); ?><?php echo e(ucwords($row->name)); ?> <?php echo trim(ob_get_clean()); ?>

</td>
<?php echo ltrim(ob_get_clean()); ?>
                        <?php ob_start(); ?><td class="py-3 px-3 first:ps-0 last:pe-0 text-sm  text-zinc-500 dark:text-zinc-300  not-in-[tr:first-child]:border-t border-zinc-800/10 dark:border-white/20 min-w-6" data-flux-cell>
    <?php ob_start(); ?>
                            <div class="flex items-center gap-2">
                                <img src="<?php echo e(env('APP_ENV') == "production" ? url(env('STORAGE_PATH').$row->logo) : asset('storage/'.$row->logo)); ?>" width="60" height="60" size="xs" />
                            </div>
                        <?php echo trim(ob_get_clean()); ?>

</td>
<?php echo ltrim(ob_get_clean()); ?>
                          <?php ob_start(); ?><td class="py-3 px-3 first:ps-0 last:pe-0 text-sm  text-zinc-500 dark:text-zinc-300  not-in-[tr:first-child]:border-t border-zinc-800/10 dark:border-white/20 max-md:hidden" data-flux-cell>
    <?php ob_start(); ?>
                             <?php ob_start(); ?><p class="[:where(&amp;)]:font-normal [:where(&amp;)]:text-sm [:where(&amp;)]:text-zinc-500 [:where(&amp;)]:dark:text-white/70 <?php echo e($row->status == 1 ?  'text-green-500' : 'text-red-500'); ?>" data-flux-text ><?php ob_start(); ?><?php echo e($row->status == 1 ?  'Active' : 'Inctive'); ?><?php echo trim(ob_get_clean()); ?></p><?php echo ltrim(ob_get_clean()); ?>
                          <?php echo trim(ob_get_clean()); ?>

</td>
<?php echo ltrim(ob_get_clean()); ?>

                        <?php ob_start(); ?><td class="py-3 px-3 first:ps-0 last:pe-0 text-sm  text-zinc-500 dark:text-zinc-300  not-in-[tr:first-child]:border-t border-zinc-800/10 dark:border-white/20" data-flux-cell>
    <?php ob_start(); ?>
                            <?php ob_start(); ?><ui-dropdown position="bottom end" offset="-15" data-flux-dropdown>
    <?php ob_start(); ?>
                                <?php ob_start(); ?><button type="button" class="relative items-center font-medium justify-center gap-2 whitespace-nowrap disabled:opacity-75 dark:disabled:opacity-75 disabled:cursor-default disabled:pointer-events-none justify-center h-8 text-sm rounded-md w-8 inline-flex -mt-1.5 -mb-1.5 bg-transparent hover:bg-zinc-800/5 dark:hover:bg-white/15 text-zinc-800 dark:text-white" data-flux-button="data-flux-button">
        <svg class="shrink-0 [:where(&amp;)]:size-5" data-flux-icon xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true" data-slot="icon">
  <path d="M3 10a1.5 1.5 0 1 1 3 0 1.5 1.5 0 0 1-3 0ZM8.5 10a1.5 1.5 0 1 1 3 0 1.5 1.5 0 0 1-3 0ZM15.5 8.5a1.5 1.5 0 1 0 0 3 1.5 1.5 0 0 0 0-3Z"/>
</svg>
    </button>
<?php echo ltrim(ob_get_clean()); ?>

                                <?php ob_start(); ?><ui-menu
    class="[:where(&amp;)]:min-w-48 p-[.3125rem] rounded-lg shadow-xs border border-zinc-200 dark:border-zinc-600 bg-white dark:bg-zinc-700 focus:outline-hidden"
    popover="manual"
    data-flux-menu
>
    <?php ob_start(); ?>
                                    <?php ob_start(); ?><ui-tooltip position="top center"  data-flux-tooltip >
        <?php ob_start(); ?>
                                    <?php ob_start(); ?><a href="<?php echo e(route('edit.intst',['id' => $row->id])); ?>" data-flux-menu-item="data-flux-menu-item" data-flux-menu-item-has-icon="data-flux-menu-item-has-icon" class="flex items-center px-2 py-1.5 w-full focus:outline-hidden rounded-md text-start text-sm font-medium [&amp;[disabled]]:opacity-50 text-zinc-800 data-active:bg-zinc-50 dark:text-white dark:data-active:bg-zinc-600 **:data-flux-menu-item-icon:text-zinc-400 dark:**:data-flux-menu-item-icon:text-white/60 [&amp;[data-active]_[data-flux-menu-item-icon]]:text-current" wire:navigate.hover="">
        <svg class="shrink-0 [:where(&amp;)]:size-5 me-2" data-flux-menu-item-icon="data-flux-menu-item-icon" data-flux-icon xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true" data-slot="icon">
  <path d="m5.433 13.917 1.262-3.155A4 4 0 0 1 7.58 9.42l6.92-6.918a2.121 2.121 0 0 1 3 3l-6.92 6.918c-.383.383-.84.685-1.343.886l-3.154 1.262a.5.5 0 0 1-.65-.65Z"/>
  <path d="M3.5 5.75c0-.69.56-1.25 1.25-1.25H10A.75.75 0 0 0 10 3H4.75A2.75 2.75 0 0 0 2 5.75v9.5A2.75 2.75 0 0 0 4.75 18h9.5A2.75 2.75 0 0 0 17 15.25V10a.75.75 0 0 0-1.5 0v5.25c0 .69-.56 1.25-1.25 1.25h-9.5c-.69 0-1.25-.56-1.25-1.25v-9.5Z"/>
</svg>

            
    <?php ob_start(); ?>Edit<?php echo trim(ob_get_clean()); ?>

    </a>
<?php echo ltrim(ob_get_clean()); ?>
                                    <?php echo trim(ob_get_clean()); ?>


                    <div popover="manual" class="relative py-2 px-2.5 rounded-md text-xs text-white font-medium bg-zinc-800 dark:bg-zinc-700 dark:border dark:border-white/10 p-0 overflow-visible" data-flux-tooltip-content>
    View

    </div>
            </ui-tooltip>
<?php echo ltrim(ob_get_clean()); ?>
                                    <?php ob_start(); ?><ui-tooltip position="top center"  data-flux-tooltip >
        <?php ob_start(); ?>
                                       <?php $__blaze->ensureRequired('/home/henry/Desktop/htdocs/grubinternetbanking/vendor/livewire/flux/src/../stubs/resources/views/flux/menu/item.blade.php', $__blaze->compiledPath.'/f05140b4e2f897973e082cff66f42e54.php'); ?>
<?php if (isset($__slotsf05140b4e2f897973e082cff66f42e54)) { $__slotsStackf05140b4e2f897973e082cff66f42e54[] = $__slotsf05140b4e2f897973e082cff66f42e54; } ?>
<?php if (isset($__attrsf05140b4e2f897973e082cff66f42e54)) { $__attrsStackf05140b4e2f897973e082cff66f42e54[] = $__attrsf05140b4e2f897973e082cff66f42e54; } ?>
<?php $__attrsf05140b4e2f897973e082cff66f42e54 = ['icon' => e($row->status == 1 ?  'x-mark' : 'check'),'wire:click' => 'EnableInstitution(\''.e($row->id).'\')','color' => '{{$row->status == 1 ?  ','red' => true,':' => true,'green' => true]; ?>
<?php $__slotsf05140b4e2f897973e082cff66f42e54 = []; ?>
<?php $__blaze->pushData($__attrsf05140b4e2f897973e082cff66f42e54); ?>
<?php ob_start(); ?><?php echo e($row->status == 1 ?  'Deactivate' : 'Activate'); ?><?php $__slotsf05140b4e2f897973e082cff66f42e54['slot'] = new \Illuminate\View\ComponentSlot(trim(ob_get_clean()), []); ?>
<?php $__blaze->pushSlots($__slotsf05140b4e2f897973e082cff66f42e54); ?>
<?php _f05140b4e2f897973e082cff66f42e54($__blaze, $__attrsf05140b4e2f897973e082cff66f42e54, $__slotsf05140b4e2f897973e082cff66f42e54, ['red', ':', 'green'], [], $__this ?? (isset($this) ? $this : null)); ?>
<?php if (! empty($__slotsStackf05140b4e2f897973e082cff66f42e54)) { $__slotsf05140b4e2f897973e082cff66f42e54 = array_pop($__slotsStackf05140b4e2f897973e082cff66f42e54); } ?>
<?php if (! empty($__attrsStackf05140b4e2f897973e082cff66f42e54)) { $__attrsf05140b4e2f897973e082cff66f42e54 = array_pop($__attrsStackf05140b4e2f897973e082cff66f42e54); } ?>
<?php $__blaze->popData(); ?>
                                  <?php echo trim(ob_get_clean()); ?>


                    <div popover="manual" class="relative py-2 px-2.5 rounded-md text-xs text-white font-medium bg-zinc-800 dark:bg-zinc-700 dark:border dark:border-white/10 p-0 overflow-visible" data-flux-tooltip-content>
    Enable/Disable

    </div>
            </ui-tooltip>
<?php echo ltrim(ob_get_clean()); ?>
                                <?php echo trim(ob_get_clean()); ?>

</ui-menu>
<?php echo ltrim(ob_get_clean()); ?>
                            <?php echo trim(ob_get_clean()); ?>

</ui-dropdown>
<?php echo ltrim(ob_get_clean()); ?>
                        <?php echo trim(ob_get_clean()); ?>

</td>
<?php echo ltrim(ob_get_clean()); ?>
                    <?php echo trim(ob_get_clean()); ?>

</tr>
<?php echo ltrim(ob_get_clean()); ?>
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
            <?php echo trim(ob_get_clean()); ?>

</tbody>
<?php echo ltrim(ob_get_clean()); ?>
        <?php echo trim(ob_get_clean()); ?>

        </table>
    </ui-table-scroll-area>

    

    </div>
<?php echo ltrim(ob_get_clean()); ?>

</div><?php /**PATH /home/henry/Desktop/htdocs/grubinternetbanking/storage/framework/views/livewire/views/adcd3cf9.blade.php ENDPATH**/ ?>