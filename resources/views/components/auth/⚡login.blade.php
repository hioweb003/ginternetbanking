<?php

use Livewire\Attributes\Layout;
use Livewire\Attributes\Validate;
use EragLaravelPwa\Facades\PWA;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Livewire\Component;

new #[Layout('layouts::guest')] class extends Component
{
    #[Validate('required|string')] 
    public $username = '';
 
    #[Validate('required|min:8|string')] 
    public $password = '';

    public $institution_name;
    public $institution_code;
    public $institution_color;
    public $institution_logo;
    public $token;

    public function mount(){

     $logo = app()->environment('production')
                ? url(env('STORAGE_PATH') . app('tenant')->logo)
                : asset('storage/' . app('tenant')->logo);

        $this->institution_name = app('tenant')->name;
        $this->institution_code = app('tenant')->code;
        $this->institution_color = app('tenant')->color_one;
        $this->institution_logo = $logo;

         $this->token = session('access_token');
        $expiresAt = session('access_token_expires_at');

          if ($this->token && !now()->greaterThan($expiresAt)) {

            return $this->redirectRoute('dashboard',['institution' => $this->institution_name],navigate:true);
        }
    }
    
    public function login()
    {
        $this->validate(); 
 
       $response = Http::withHeaders([
        "content-type" => "application/json"
       ])->post(config('services.api.base_url')."customers/login",[
        "username" => $this->username,
        "password" => $this->password,
        "device_id" => 'web',
        'institution_code' => $this->institution_code
       ])->json();
 
        Log::info("login response",$response);

        if($response["status"] === true){
            //$userId = $response["data"]["uuid"];

                session(['access_token' => $response["data"]["access_token"],'access_token_expires_at' => now()->addMinutes(25)]);

             return $this->redirect('/dashboard');

        }else{
             $this->dispatch('notify',
                        type: 'error',
                        message: $response["message"],
                        position: 'center',
                        timer:3000,
                        button:false
                    );
        }
       
    }

    
};
?>

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

     <form wire:transition class="space-y-5" wire:submit.prevent="login">

                <!-- Username -->
                <div>
                    <input type="text"
                        placeholder="Username"
                        wire:model='username'
                        class="w-full px-4 py-3 rounded-lg border border-gray-200 focus:ring-1 focus:ring-gray-400 focus:outline-none">
                        @error('username')
                           <span class='text-red-500 mt-2'> {{ $message }}</span>
                        @enderror
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
                      @error('password')
                            <span class='text-red-500 mt-2'> {{ $message }}</span>
                        @enderror
                </div>
                
                {{-- <input type="text" wire:model='institution_color'> --}}
                <!-- Remember + Forgot -->
                <div class="flex items-center justify-between text-sm text-gray-600">
                    <label class="flex items-center gap-2">
                        {{-- <input type="checkbox" class="accent-blue-900">
                        Remember me --}}
                    </label>
                    <a href="{{ route('account.forgetpasswrd', ['institution' => $institution_name ]) }}" wire:navigate.hover class="text-black hover:underline ">
                        Forgot Password
                    </a>
                </div>

                <!-- Login Button -->
           <button
                    type="submit"
                    style="background-color: {{ $institution_color }}"
                    class="w-full text-white py-3 rounded-lg font-semibold transition hover:brightness-90 cursor-pointer"
                    wire:loading.attr="disabled"
                >
                    <span wire:loading.remove>Login</span>
                    <span wire:loading wire:target="login" >
                        <i class="fa fa-spinner fa-spin"></i>
                    </span>
                </button>

            </form>

            <!-- Setup Banking -->
            <div class="mt-8 text-center text-sm text-gray-600">
                Don't have an account with us?
                <a href="{{ route('create.account', ['institution' => $institution_name]) }}" wire:navigate.hover class="hover:underline text-gray-800">
                    Register
                </a>
            </div>
</div>