<?php

use Livewire\Attributes\Layout;
use Livewire\Component;

new #[Layout('layouts::guest',['title' => 'Verify Phone Number'])] class extends Component
{
     public int $institution_code;
    public string $institution_color;
    public string $institution_logo;
    public string $institution_name;
 
    public function mount(){

          $tenant = app('tenant');

        $this->institution_name = $tenant->name;
        $this->institution_code = $tenant->code;
        $this->institution_color = $tenant->color_one;
        $this->institution_logo = app()->environment('production')
                ? url(env('STORAGE_PATH') . $tenant->logo)
                : asset('storage/' . $tenant->logo);

    }

    
};
?>

<div class="w-full max-w-md">
            <!-- Logo -->
            <div class="mb-6">
                <h1 class="text-xl font-bold text-orange-600">
                    <img src="{{ $institution_logo }}" width="60" height="60" alt="">
                </h1>
            </div>

            <!-- Heading -->
            <h2 class="text-3xl font-semibold mb-2">Log in</h2>
            <p class="text-gray-500 mb-8">
                Welcome back! Please enter your details.
            </p>

            <!-- Form -->
             <form class="space-y-5" wire:submit="login">

                <!-- Username -->
                <div>
                    <input type="text"
                        placeholder="Username or Account Number"
                        class="w-full px-4 py-3 rounded-lg border border-gray-200 focus:ring-1 focus:ring-gray-400 focus:outline-none">
                </div>

                <!-- Password -->
                <div class="relative" x-data="{showPassword: false}">
                    <input :type="showPassword ? 'text' : 'password'"
                        placeholder="Password"
                        wire:model="password"
                        class="w-full px-4 py-3 rounded-lg border border-gray-200 focus:ring-1 focus:ring-gray-400 focus:outline-none">
                    <span class="absolute right-4 top-3 text-gray-400 cursor-pointer" x-on:click="showPassword = !showPassword">
                        <i x-show="!showPassword" class="fa fa-eye"></i>
                        <i x-show="showPassword" class="fa fa-eye-slash"></i>
                    </span>
                </div>

                <!-- Remember + Forgot -->
                <div class="flex items-center justify-between text-sm text-gray-600">
                    <label class="flex items-center gap-2">
                        {{-- <input type="checkbox" class="accent-blue-900">
                        Remember me --}}
                    </label>
                    <a href="{{ route('account.forgetpasswrd', ['institution' => $institution_name]) }}" wire:navigate.hover class="text-black hover:underline ">
                        Forgot Password
                    </a>
                </div>

                <!-- Login Button -->
                <button
                    class="w-full bg-blue-500 hover:bg-blue-900 text-white py-3 rounded-lg font-semibold transition cursor-pointer">
                    Verify
                </button>

            </form>

            <!-- Setup Banking -->
            <div class="mt-8 text-center text-sm text-gray-600">
                Already have an account?
                <a href="{{ route('home', ['institution' => $institution_name]) }}"  class="hover:underline text-gray-800">
                    Login
                </a>
            </div>

</div>