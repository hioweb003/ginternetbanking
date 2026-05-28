<?php 
 $logo = app()->environment('production')
                ? url(env('STORAGE_PATH') . app('tenant')->logo)
                : asset('storage/' . app('tenant')->logo);
?>
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
         @PwaHead
        <title>{{ $title ?? config('app.name') }}</title>
         <link rel="shortcut icon" href="{{ $logo }}">

        @vite(['resources/css/app.css', 'resources/js/app.js'])

        @livewireStyles
        @fluxAppearance
         <!-- FontAwesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">


    <style>
        body { font-family: 'Inter', sans-serif; }
        .glass {
            backdrop-filter: blur(12px);
            background: rgba(255,255,255,0.6);
        }
        .dark .glass {
            background: rgba(31,41,55,0.6);
        }

        /* Container */
            .swal-modal {
                width: 90% !important;
                max-width: 320px;
                border-radius: 12px;
                padding: 5px;
            }

            /* Title */
            .swal-title {
                font-size: 18px;
                font-weight: 600;
                margin-bottom: 10px;
            }

            /* Text */
            .swal-text {
                font-size: 14px;
                color: #555;
                text-align: center;
            }

            /* make button take full width */
            .swal-button-container {
                width: 100%;
            }

            /* Button */
            .swal-button.swal-btn-mobile {
                width: 100% !important;
                 display: block;
                background: #d8dadf !important;
                color: #444343 !important;
                font-size: 14px;
                padding: 5px;
            }
      

            /* Remove default focus outline */
            .swal-button:focus {
                outline: none;
            }
    </style>
    </head>
   <body class="bg-gray-100 dark:bg-gray-900 transition-all duration-500">

    <div class="min-h-screen flex flex-col md:flex-row">

    <!-- Overlay (Mobile) -->
    <div id="overlay" onclick="toggleSidebar()" class="fixed inset-0 bg-black/40 hidden z-30 md:hidden"></div>

         @include('inc.sidebar')

             <!-- Main -->
    <div class="flex-1 flex flex-col w-full min-w-0">
            @include('inc.header')

        {{ $slot }}

  
    </div>
    <!-- Mobile Bottom Navigation -->
<div class="fixed bottom-0 left-0 right-0 z-50 md:hidden">

    <div class="bg-white dark:bg-zinc-900 border-t border-zinc-200 rounded-l-2xl rounded-r-2xl dark:border-zinc-700">

        <div class="grid grid-cols-4 h-16">

            <!-- Home -->
            <a href="{{ route('dashboard',['institution' => app('tenant')->name]) }}"
               wire:navigate.hover
               class="flex flex-col items-center justify-center gap-1">

                <i class="fa fa-home text-lg {{ request()->routeIs('dashboard') ? 'text-gradient-to-r' : 'text-zinc-400' }}"></i>

                <span class="text-xs {{ request()->routeIs('dashboard') ? 'text-gradient-to-r font-medium' : 'text-zinc-500' }}"
                         @if(request()->routeIs('dashboard'))
                    style="color: {{ app('tenant')->color_one }};"
                @endif>
                    Home
                </span>

            </a>

            <!-- Services -->
            <a href="{{ route('servces',['institution' => app('tenant')->name]) }}"
               wire:navigate
               class="flex flex-col items-center justify-center gap-1">

                <i class="fa fa-th-large text-lg {{ request()->routeIs('services') ? 'text-gradient-to-r' : 'text-zinc-400' }}"></i>

                <span class="text-xs {{ request()->routeIs('servces') ? 'text-gradient-to-r font-medium' : 'text-zinc-500' }}"
                    @if(request()->routeIs('servces'))
                    style="color: {{ app('tenant')->color_one }};"
                @endif>
                    Services
                </span>

            </a>

            <!-- Card -->
            {{-- <a href="{{ route('cards') }}"
               wire:navigate
               class="flex flex-col items-center justify-center gap-1">

                <i class="fa fa-credit-card text-lg {{ request()->routeIs('cards') ? 'text-orange-500' : 'text-zinc-400' }}"></i>

                <span class="text-xs text-zinc-500">
                    Card
                </span>

            </a> --}}

            <!-- History -->
            <a href="{{ route('trxshity',['institution' => app('tenant')->name]) }}" wire:navigate.hover 
               class="flex flex-col items-center justify-center gap-1">

                <i class="fa fa-file-alt text-lg {{ request()->routeIs('transactions') ? 'text-gradient-to-r' : 'text-zinc-400' }}"></i>

                <span class="text-xs {{ request()->routeIs('trxshity') ? 'text-gradient-to-r font-medium' : 'text-zinc-500' }}"
                 @if(request()->routeIs('trxshity'))
                    style="color: {{ app('tenant')->color_one }};"
                @endif   >
                    History
                </span>

            </a>

            <!-- Profile -->
            <a href="{{ route('muen',['institution' => app('tenant')->name]) }}" wire:navigate.hover
               class="flex flex-col items-center justify-center gap-1">

                <i class="fa fa-user-circle text-lg {{ request()->routeIs('profile') ? 'text-gradient-to-r' : 'text-zinc-400' }}"></i>

                <span class="text-xs {{ request()->routeIs('muen') ? 'text-gradient-to-r font-medium' : 'text-zinc-500' }}"
                 @if(request()->routeIs('muen'))
                    style="color: {{ app('tenant')->color_one }};"
                @endif >
                    Menu
                </span>

            </a>

        </div>

    </div>

</div>
 </div>
    
        @livewireScripts
         @fluxScripts
         @RegisterServiceWorkerScript

 <script>

    function toggleSidebar() {
const sidebar = document.getElementById('sidebar');
const overlay = document.getElementById('overlay');
sidebar.classList.toggle('-translate-x-full');
overlay.classList.toggle('hidden');
}


function applyTheme() {
    const html = document.documentElement;
    const slider = document.getElementById("toggleSlider");

    const saved = localStorage.getItem("theme") || "light";

    if (saved === "dark") {
        html.classList.add("dark");
        html.classList.remove("light");
        if (slider) slider.style.transform = "translateX(100%)";
    } else {
        html.classList.remove("dark");
        html.classList.add("light");
        if (slider) slider.style.transform = "translateX(0)";
    }
}

// Run on first load
document.addEventListener("DOMContentLoaded", applyTheme);

// 🔑 Run after EVERY Livewire navigation
document.addEventListener("livewire:navigated", applyTheme);

// Toggle stays global
window.toggleDark = function (mode) {
    const html = document.documentElement;
    const slider = document.getElementById("toggleSlider");

    if (!slider) return;

    if (mode === "dark") {
        html.classList.add("dark");
        html.classList.remove("light");
        localStorage.setItem("theme", "dark");
        slider.style.transform = "translateX(100%)";
    }

    if (mode === "light") {
        html.classList.remove("dark");
        html.classList.add("light");
        localStorage.setItem("theme", "light");
        slider.style.transform = "translateX(0)";
    }
};



function toggleBalance() {
    const balance = document.getElementById('balanceText');
    const balancehide = document.getElementById('balanceTexthd');
    const eye = document.getElementById('eyeIcon');

    if (balance.innerText.includes('*')) {
         balance.style.display='block';
        balancehide.style.display='hide';
        eye.classList.remove('fa-eye-slash');
        eye.classList.add('fa-eye');
    } else {
        balance.style.display='none';
        balancehide.style.display='block';
        eye.classList.remove('fa-eye');
        eye.classList.add('fa-eye-slash');
    }
}

function setMode(mode) {
    const testBtn = document.getElementById('testBtn');
    const liveBtn = document.getElementById('liveBtn');

    if (mode === 'test') {
        testBtn.classList.add('bg-yellow-400','text-black');
        liveBtn.classList.remove('bg-green-500','text-white');
        liveBtn.classList.add('text-gray-600','dark:text-gray-300');
    } else {
        liveBtn.classList.add('bg-green-500','text-white');
        testBtn.classList.remove('bg-yellow-400','text-black');
        testBtn.classList.add('text-gray-600','dark:text-gray-300');
    }
}

window.addEventListener('DOMContentLoaded', () => {
    const menuItems = document.querySelectorAll('.menu-item');

    menuItems.forEach(item => {
        item.addEventListener('click', function() {
            menuItems.forEach(i => {
                i.classList.remove('bg-indigo-600','text-white','shadow-lg');
            });
            this.classList.add('bg-indigo-600','text-white','shadow-lg');
        });
    });
});
</script>

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
                        position: 'center',
                         buttons: {
                            confirm: {
                                text: "Okay",
                                value: true,
                                visible: true,
                                className: "swal-btn-mobile"
                            }
                        },

                        closeOnClickOutside: false,
                        closeOnEsc: false,
                    });

            });
   </script>
    </body>
</html>
