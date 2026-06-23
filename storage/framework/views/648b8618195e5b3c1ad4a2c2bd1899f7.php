<?php 
 $logo = app()->environment('production')
                ? url(env('STORAGE_PATH') . app('tenant')->logo)
                : asset('storage/' . app('tenant')->logo);
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title><?php echo e($title ?? "Login"); ?></title>
 <?php echo app(\EragLaravelPwa\Services\PWAService::class)->headTag(); ?>
 <link rel="shortcut icon" href="<?php echo e(storage_path('app/public/' .app('tenant')->logo)); ?>" type="image/x-icon">
<link rel="manifest" href="<?php echo e(route('manifest',['institution' => app('tenant')->name])); ?>">
 <?php echo app('Illuminate\Foundation\Vite')(['resources/css/app.css', 'resources/js/app.js']); ?>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

  <?php echo \Livewire\Mechanisms\FrontendAssets\FrontendAssets::styles(); ?>

        
</head>

<body class="bg-white">

<div class="min-h-screen flex">
 
    <!-- LEFT SIDE (Login Form) -->
    <div class="w-full lg:w-1/3 bg-white flex items-center justify-center px-6 py-12">

                <?php echo e($slot); ?> 
        
    </div>


    <!-- RIGHT SIDE (Image - Hidden on Mobile) -->
    <div class="hidden lg:block lg:w-4/5 relative">

        <img src="<?php echo e(asset('img/16105.jpg')); ?>"
            class="w-full h-full object-cover"
            alt="Login Image">

        <!-- Optional overlay gradient -->
        <div class="absolute inset-0 bg-black/10"></div>

        <!-- Support Button -->
        

    </div>

</div>

 <?php echo \Livewire\Mechanisms\FrontendAssets\FrontendAssets::scripts(); ?>

         
         <?php echo app(\EragLaravelPwa\Services\PWAService::class)->registerServiceWorkerScript(); ?>

         
          <script src="<?php echo e(asset('js/sweetalert.js')); ?>" ></script>

<script>
      window.addEventListener('notify',(event) => {
            const data = event.detail;
            
                swal({
                        icon: data.type,
                        text: data.message,
                        position: data.position,
                        timer: data.timer,
                        buttons: data.button,
                    });

            });
   </script>
</body>
</html><?php /**PATH /home/henry/Desktop/htdocs/grubinternetbanking/resources/views/layouts/guest.blade.php ENDPATH**/ ?>