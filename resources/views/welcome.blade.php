<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>{{$title ?? "Login"}}</title>
 @PwaHead
 @vite(['resources/css/app.css', 'resources/js/app.js'])
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

 <link rel="shortcut icon" href="{{$institution_logo}}">

</head>

<body class="bg-gray-100">

<div class="min-h-screen flex">

    <!-- LEFT SIDE (Login Form) -->
    <div class="w-full lg:w-1/3 bg-white flex items-center justify-center px-6 py-12">

        <div class="w-full max-w-md">

            <!-- Logo -->
            <div class="mb-6">
                <h1 class="text-xl font-bold text-orange-600">
                    <img src="{{ $institution_logo}}" width="60" height="60" alt="">
                </h1>
            </div>

            <!-- Heading -->
            <h2 class="text-3xl font-semibold mb-2">Log in</h2>
            <p class="text-gray-500 mb-8">
                Welcome back! Please enter your details.
            </p>

            <!-- Form -->
           <livewire:auth.login :code="$institution_code" :color="$institution_color" />

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

         @RegisterServiceWorkerScript


</body>
</html>