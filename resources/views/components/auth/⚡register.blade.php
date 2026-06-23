<?php

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Livewire\Attributes\Layout;
use Livewire\Attributes\On;
use Livewire\Attributes\Validate;
use Livewire\Component;

new #[Layout('layouts::guest',['title' => 'Register New Account'])] class extends Component
{
     public int $institution_code;
    public string $institution_color;
    public string $institution_colortwo;
    public string $institution_logo;
    public string $institution_name;   
    public string $institution_fullname;
    public string $password;
    public string $username;
    public string $bvn;
    public string $first_name;
    public string $last_name;
    public string $dob;
    public string $email;
    public string $phone_number;
    public int $pin;
    public string $gender = "";

    
    #[Validate('required|digits:11|numeric')]
    public string $BvnNumber;

    public $nextpg = 1;
    
    
    public function mount(){

        $tenant = app('tenant');

        $this->institution_name = $tenant->name;
        $this->institution_code = $tenant->code;
        $this->institution_color = $tenant->color_one;
        $this->institution_logo = app()->environment('production')
                ? url(env('STORAGE_PATH') . $tenant->logo)
                : asset('storage/' . $tenant->logo);

    }

      public function VerifyBvnNumber()
    {

        $this->validate();

         $response = Http::withHeaders([
         ])->post(config('services.api.base_url')."bvn/verification", [
            'bvn' => $this->BvnNumber,
            'institution_code' => $this->institution_code
        ])->json();

        Log::info('bvn response',$response);

        if($response['status'] === true) {
            // Handle successful verification
                session()->flash('success', 'BVN verification successful!');
                
             
                $this->first_name = $response["data"]["first_name"];
                $this->last_name = $response["data"]["lastname"];
                $this->dob = $response["data"]["dob"];
                $this->bvn = $this->BvnNumber;
             
                     $this->nextpg++;


                // return $this->redirectRoute('account.create', ['institution' => $this->institution_name],navigate:true);

                
        } else {
            // Handle verification failure
            session()->flash('error', 'BVN verification failed!');
        }
    }
      
     public function profile(){
         $this->validate([
                'email' => 'required|string|email:rfc,dns,spoof,filter',
                'phone_number' => 'required|digits:11|numeric',
                'username' => 'required|string',
                'gender' => 'required|string',
         ]);

          $this->nextpg++;
     }

        public function CreateAccount()
        {

            $this->validate([
                    'pin' => 'required|digits:4|numeric',
                    'password' => 'required|string|min:8',
            ]);
            // Implement account creation logic here


         $response = Http::withHeaders([
            'content-type' => 'application/json',
         ])->post(config('services.api.base_url')."customers/register", [
             "first_name" => $this->first_name,
            "last_name" => $this->last_name,
            "phone" => $this->phone_number,
            "email" => $this->email,
            "dob" => $this->dob,
            "gender" => $this->gender,
            "username" => $this->username,
            "pin" => $this->pin,
            "password" => $this->password,
            'bvn' => $this->BvnNumber,
            'institution_code' => $this->institution_code
        ])->json();

             if($response['status'] === true) {
                 $this->dispatch('notify',
                        type: 'success',
                        message: $response["message"],
                        position: 'center',
                        button:false
                    );

            return $this->redirectRoute('home', ['institution' => $this->institution_name],navigate:true);

             // return redirect()->route('home', ['institution' => $this->institution_name]);

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

           @if ($nextpg == 1)
               
                  <!-- Logo -->
            <div class="mb-6">
                <h1 class="text-xl font-bold text-orange-600">
                    <img src="{{ $institution_logo }}" width="60" height="60" alt="">
                </h1>
            </div>

            <!-- Heading -->
            <h4 class="text-3xl font-semibold mb-2">Register</h4>
            <p class="text-gray-500 mb-8">
                Register New Account
            </p>
          @if (session()->has('success'))
                    <div wire:transition class="text-green-600">
                        {{ session('success') }}
                    </div>
                @endif
                  @if (session()->has('error'))
                    <div wire:transition class="text-red-600">
                        {{ session('error') }}
                    </div>
                @endif
            
            <!-- Form -->
             <form wire:transition class="space-y-5" wire:submit.prevent='VerifyBvnNumber'>

                <!-- Username -->
                <div>
                    <input type="text"
                        placeholder="Enter Bvn Number"
                        maxlength="11"
                        wire:model="BvnNumber"
                        class="w-full px-4 text-gray-900 py-3 rounded-lg border border-gray-200 focus:ring-1 focus:ring-gray-400 focus:outline-none">
                </div>



                <!-- Login Button -->
                <button style="background-color: {{ $institution_color }};"
                    class="w-full text-white py-3 rounded-lg font-semibold transition hover:brightness-90"
                    wire:loading.attr="disabled">
                
                    <span wire:loading.remove>Continue</span>
                    <span wire:loading wire:target="VerifyBvnNumber" >
                        <i class="fa fa-spinner fa-spin"></i>
                    </span>
                </button>

            </form>

           @endif 
           
           @if ($nextpg == 2)
               
                 <!-- Logo -->
            <div class="mb-6">
                <h1 class="text-xl font-bold text-orange-600">
                    <img src="{{ $institution_logo }}" width="60" height="60" alt="">
                </h1>
            </div>

            <!-- Heading -->
            <h4 class="text-3xl font-semibold mb-2"> Create Profile</h4>
            <p class="text-gray-500 mb-8">
               Account profile
            </p>

            <!-- Form -->
             <form wire:transition class="space-y-5" wire:submit.prevent="profile">

                   <div>
                    <input type="text"
                        placeholder="First Name" readonly
                        wire:model='first_name'
                        class="w-full px-4 py-3 text-gray-900 rounded-lg border border-gray-200 focus:ring-1 focus:ring-gray-400 focus:outline-none">
                </div>
                   <div>
                    <input type="text"
                      wire:model='last_name'
                        placeholder="Last Name" readonly
                        class="w-full px-4 py-3 text-gray-900 rounded-lg border border-gray-200 focus:ring-1 focus:ring-gray-400 focus:outline-none">
                </div>

                 <div>
                    <input type="date" wire:model='dob' max='2008-12-31' min="1930-01-01"
                        placeholder="date of Birth" readonly
                        class="w-full px-4 py-3 text-gray-900 rounded-lg border border-gray-200 focus:ring-1 focus:ring-gray-400 focus:outline-none">
                </div>

                <div>
                    <select wire:model='gender' class="w-full px-4 py-3 text-gray-900 rounded-lg border border-gray-200 focus:ring-1 focus:ring-gray-400 focus:outline-none">
                        <option value="">Select Gender</option>
                        <option value="male">Male</option>
                        <option value="female">Female</option>
                    </select>
                       @error('gender')
                        <p class="text-red-400 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                   <div>
                    <input type="tel" wire:model='phone_number'
                        placeholder="Phone Number"
                        class="w-full px-4 py-3 text-gray-900 rounded-lg border border-gray-200 focus:ring-1 focus:ring-gray-400 focus:outline-none">
                   @error('phone_number')
                        <p class="text-red-400 text-sm mt-1">{{ $message }}</p>
                    @enderror
                    </div>

                <div>
                    <input type="email"
                        placeholder="email" wire:model='email'
                        class="w-full px-4 py-3 text-gray-900 rounded-lg border border-gray-200 focus:ring-1 focus:ring-gray-400 focus:outline-none">
                       @error('email')
                        <p class="text-red-400 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <input type="text"
                        placeholder="Username" wire:model.defer='username'
                        class="w-full px-4 py-3 text-gray-900 rounded-lg border border-gray-200 focus:ring-1 focus:ring-gray-400 focus:outline-none">
                     @error('username')
                        <p class="text-red-400 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

               

                <!-- Login Button -->
                <button style="background-color: {{ $institution_color }}"
                    class="w-full text-white py-3 rounded-lg font-semibold transition hover:brightness-90"
                    wire:loading.attr="disabled">
                    
                       <span wire:loading.remove>Continue</span>
                    <span wire:loading wire:target="profile" >
                        <i class="fa fa-spinner fa-spin"></i>
                    </span>
                </button>

            </form>

           @endif

            @if ($nextpg == 3)
               
                 <!-- Logo -->
            <div class="mb-6">
                <h1 class="text-xl font-bold text-orange-600">
                    <img src="{{ $institution_logo }}" width="60" height="60" alt="">
                </h1>
            </div>

            <!-- Heading -->
            <h4 class="text-3xl font-semibold mb-2">Create Password/Pin </h4>
            <p class="text-gray-500 mb-8">
               Account Secret
            </p>

            <!-- Form -->
             <form wire:transition class="space-y-5" wire:submit.prevent="CreateAccount">

                 <!-- Password -->
                <div class="relative" x-data="{showPin: false}">
                    <input :type="showPin ? 'text' : 'password'"
                        placeholder="Pin"
                        wire:model="pin"
                        class="w-full px-4 py-3 text-gray-900 rounded-lg border border-gray-200 focus:ring-1 focus:ring-gray-400 focus:outline-none">
                    <span class="absolute right-4 top-3 text-gray-400 cursor-pointer" x-on:click="showPin = !showPin">
                        <i x-show="!showPin" class="fa fa-eye"></i>
                        <i x-show="showPin" class="fa fa-eye-slash"></i>
                    </span>
                       @error('pin')
                        <p class="text-red-400 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                 <!-- Password -->
                <div class="relative" x-data="{showPassword: false}">
                    <input :type="showPassword ? 'text' : 'password'"
                        placeholder="Password"
                        wire:model="password"
                        class="w-full px-4 py-3 text-gray-900 rounded-lg border border-gray-200 focus:ring-1 focus:ring-gray-400 focus:outline-none">
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
                    
                       <span wire:loading.remove>Create Account</span>
                    <span wire:loading wire:target="CreateAccount" >
                        <i class="fa fa-spinner fa-spin"></i>
                    </span>
                </button>

             </form>
             @endif

            <!-- Setup Banking -->
            <div class="mt-8 text-center text-sm text-gray-600">
                Already have an account?
                <a href="{{ route('home', ['institution' => $institution_name]) }}" wire:navigate.hover  class="hover:underline text-gray-800">
                    Login
                </a>
            </div>

</div>