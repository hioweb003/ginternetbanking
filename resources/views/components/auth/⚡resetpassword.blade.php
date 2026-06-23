<?php
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Url;
use Livewire\Attributes\Validate;
use Livewire\Component;

new #[Layout('layouts::guest',['title' => 'Reset Password'])] class extends Component
{
    public int $institution_code;
    public string $institution_color;
    public string $institution_logo;
    public string $institution_name;

    #[Validate('required|string|min:8')]
    public string $password;

     #[Url(history: true)]
    public string $code;
 
    public function mount(){

        $tenant = app('tenant');

        $this->institution_name = $tenant->name;
        $this->institution_code = $tenant->code;
        $this->institution_color = $tenant->color_one;
        $this->institution_logo = app()->environment('production')
                ? url(env('STORAGE_PATH') . $tenant->logo)
                : asset('storage/' . $tenant->logo);


    }


    public function ResetPassword(){

        $this->validate();

        $otpcode = Crypt::decryptString($this->code);

          $response = Http::withHeaders([
         ])->post(config('services.api.base_url')."customers/reset-password", [
            'otpcode' => $otpcode,
            'password' => $this->password,
            'institution_code' => $this->institution_code
        ])->json();

        Log::info('resetpassword response',$response);

        if($response['status'] === true) {
           
                   $this->dispatch('notify',
                        type: 'success',
                        message: $response["message"],
                        position: 'center',
                        button:false
                    );

            return $this->redirectRoute('home', ['institution' => $this->institution_name],navigate:true);

        } else {
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
                    <img src="{{ $institution_logo }}" width="60" height="60" alt="">
                </h1>
            </div>

            <!-- Heading -->
            <h2 class="text-3xl font-semibold mb-2">Password Reset</h2>
            <p class="text-gray-500 mb-8">
                Reset Password.
            </p>

            <!-- Form -->
             <form wire:transition class="space-y-5" wire:submit="ResetPassword">

               
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
                        <p class="text-red-400 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Login Button -->
                <button style="background-color: {{ $institution_color }}"
                    class="w-full text-white py-3 rounded-lg font-semibold transition hover:brightness-90 cursor-pointer"
                    wire:loading.attr="disabled">
                    
                       <span wire:loading.remove>Reset Password</span>
                    <span wire:loading wire:target="ResetPassword" >
                        <i class="fa fa-spinner fa-spin"></i>
                    </span>
                </button>

            </form>

            <!-- Setup Banking -->
            <div class="mt-8 text-center text-sm text-gray-600">
                 Already have an account?
                <a href="{{ route('home', ['institution' => $institution_name]) }}" wire:navigate.hover  class="hover:underline text-gray-800">
                   Login
                </a>
            </div>

</div>