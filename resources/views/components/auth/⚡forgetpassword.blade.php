<?php
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Validate;
use Livewire\Component;

new #[Layout('layouts::guest',['title' => 'Forget Password'])] class extends Component
{
    public int $institution_code;
    public string $institution_color;
    public string $institution_logo;
    public string $institution_name;

    #[Validate('required|string|email:rfc,dns,spoof,filter')]
    public string $email;
 
    public function mount(){

          $tenant = app('tenant');

        $this->institution_name = $tenant->name;
        $this->institution_code = $tenant->code;
        $this->institution_color = $tenant->color_one;
        $this->institution_logo = app()->environment('production')
                ? url(env('STORAGE_PATH') . $tenant->logo)
                : asset('storage/' . $tenant->logo);

    }


    public function ForgetPassword(){
        $this->validate();

          $response = Http::withHeaders([
         ])->post(config('services.api.base_url')."customers/forgot-password", [
            'email' => $this->email,
            'institution_code' => $this->institution_code
        ])->json();

        Log::info('forgetpassword response',$response);

        if($response['status'] === true) {
            // Handle successful verification
        
                   $this->dispatch('notify',
                        type: 'success',
                        message: $response["message"],
                        position: 'center',
                        button:false
                    );

            return $this->redirectRoute('account.confrimotp', ['institution' => $this->institution_name,'em' => Crypt::encryptString($this->email)],navigate:true);

        } else {
            // Handle verification failure
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
            <h2 class="text-3xl font-semibold mb-2">Forget Password</h2>
            <p class="text-gray-500 mb-8">
                Forgot Your Password?
            </p>

            <!-- Form -->
             <form class="space-y-5" wire:submit="ForgetPassword">

                <!-- Username -->
                <div>
                    <input type="email"
                        placeholder="Enter Email",
                        wire:model='email'
                        class="w-full px-4 py-3 text-gray-900 rounded-lg border border-gray-200 focus:ring-1 focus:ring-gray-400 focus:outline-none">
                
                 @error('email')
                        <p class="text-red-400 text-sm mt-1">{{ $message }}</p>
                    @enderror
            </div>

                <!-- Login Button -->
                <button style="background-color: {{ $institution_color }}"
                    class="w-full text-white py-3 rounded-lg font-semibold transition hover:brightness-90 cursor-pointer"
                    wire:loading.attr="disabled">
                     <span wire:loading.remove>Submit</span>
                    <span wire:loading wire:target="ForgetPassword" >
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