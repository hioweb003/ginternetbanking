<?php # [BlazeFolded]:{flux::separator}:{/home/henry/Desktop/htdocs/grubinternetbanking/vendor/livewire/flux/src/../stubs/resources/views/flux/separator.blade.php}:{1776985208} ?>
<!DOCTYPE html>
<html lang="<?php echo e(str_replace('_', '-', app()->getLocale())); ?>">
    <head>
        <meta charset="utf-8">
        <title>Admin Login</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="shortcut icon" href="<?php echo e(asset('img/1742153723_GrubiesCore.png')); ?>">

        <?php echo app('Illuminate\Foundation\Vite')(['resources/css/app.css', 'resources/js/app.js']); ?>
       
        <?php echo \Livewire\Mechanisms\FrontendAssets\FrontendAssets::styles(); ?>

    <?php echo app('flux')->fluxAppearance(); ?>

</head>
<body class="min-h-screen bg-white dark:bg-zinc-800 antialiased">

    <div class="flex min-h-screen">
    <div class="flex-1 flex justify-center items-center">
        <div class="w-80 max-w-80 space-y-6">
            <div class="flex justify-center">
                <a href="<?php echo e(route('login')); ?>" wire:navigate.hover class="group flex items-center gap-3">
                    <div>
                        <img src="<?php echo e(asset('img/1742153723_GrubiesCore.png')); ?>" class="h-20 text-zinc-800 dark:text-white" alt="">
                    </div>

                    <span class="text-xl font-semibold text-zinc-800 dark:text-white">Grubies Internet Banking</span>
                </a>
            </div>

          

            <?php ob_start(); ?><div data-orientation="horizontal" role="none" class="border-0 [print-color-adjust:exact] bg-zinc-800/15 dark:bg-white/20 h-px w-full" data-flux-separator></div>
<?php echo ltrim(ob_get_clean()); ?>

             <?php
$__split = function ($name, $params = []) {
    return [$name, $params];
};
[$__name, $__params] = $__split('auth.adminlogin', []);

$__keyOuter = $__key ?? null;

$__key = null;
$__componentSlots = [];

$__key ??= \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::generateKey('lw-3820547561-0', $__key);

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

    <div class="flex-1 p-4 max-lg:hidden">
        <div class="text-white relative rounded-lg h-full w-full bg-zinc-900 flex flex-col items-start justify-end p-16" style="background-image: url('/img/2151914227.jpg'); repeat:no-repeat; position:center; background-size: cover">
           
        </div>
    </div>
</div>

       <?php app('livewire')->forceAssetInjection(); ?>
<?php echo app('flux')->scripts(); ?>

</body>
</html><?php /**PATH /home/henry/Desktop/htdocs/grubinternetbanking/resources/views/login-admin.blade.php ENDPATH**/ ?>