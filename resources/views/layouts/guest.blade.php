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
<title>{{$title ?? "Login"}}</title>
 @PwaHead
 <link rel="shortcut icon" href="{{$logo}}">

 @vite(['resources/css/app.css', 'resources/js/app.js'])

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

  @livewireStyles
        {{-- @fluxAppearance --}}
</head>

<body class="bg-gray-100">

<div class="min-h-screen flex">
 
    <!-- LEFT SIDE (Login Form) -->
    <div class="w-full lg:w-1/3 bg-white flex items-center justify-center px-6 py-12">

        <div class="w-full max-w-md">
        {{ $slot }} 
        </div>
    </div>


    <!-- RIGHT SIDE (Image - Hidden on Mobile) -->
    <div class="hidden lg:block lg:w-4/5 relative">

        <img src="{{ asset('img/16105.jpg') }}"
            class="w-full h-full object-cover"
            alt="Login Image">

        <!-- Optional overlay gradient -->
        <div class="absolute inset-0 bg-black/10"></div>

        <!-- Support Button -->
        {{-- <div class="absolute bottom-6 right-6 bg-orange-500 text-white p-4 rounded-xl shadow-lg cursor-pointer hover:bg-orange-600 transition">
            <i class="fa fa-headset text-xl"></i>
        </div> --}}

    </div>

</div>

 @livewireScripts
         {{-- @fluxScripts --}}
         @RegisterServiceWorkerScript

         {{-- <script>
            if (!window.pwaInitialized) {

                    window.pwaInitialized = true;

                    window.deferredPrompt = null;

                    window.addEventListener('beforeinstallprompt', (e) => {
                        window.deferredPrompt = e;
                    });

                }
         </script> --}}
          <script src="{{asset('js/sweetalert.js')}}" ></script>

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
</html>