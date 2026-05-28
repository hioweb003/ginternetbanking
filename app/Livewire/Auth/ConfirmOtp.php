<?php

namespace App\Livewire\Auth;

use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Url;
use Livewire\Attributes\Validate;
use Livewire\Component;

class ConfirmOtp extends Component
{
    public $institution_code;
    public $institution_color;
    public $institution_logo;
    public $institution_name;

    #[Validate('required|numeric|digits:4')]
    public $otpcode;

    #[Url(history: true)]
    public $em;

    public $resnd = false;
 
    public function mount(){

        $tenant = app('tenant');

        $this->institution_name = $tenant->name;
        $this->institution_code = $tenant->code;
        $this->institution_color = $tenant->color_one;
        $this->institution_logo = app()->environment('production')
                ? url(env('STORAGE_PATH') . $tenant->logo)
                : asset('storage/' . $tenant->logo);
  
    }

    #[Layout('layouts::guest',['title' => 'Confirm OTP'])]
    public function render()
    {
        return view('livewire.auth.confirm-otp');
    }

     public function ConfirmOtp(){

        $this->validate();

          $response = Http::withHeaders([
         ])->post(config('services.api.base_url')."customers/verify-otp", [
            'otp_code' => $this->otpcode,
            'institution_code' => $this->institution_code
        ])->json();


        if($response['status'] === true) {
           
                   $this->dispatch('notify',
                        type: 'success',
                        message: $response["message"],
                        position: 'center',
                        button:false
                    );

            return $this->redirectRoute('account.resetpassword', ['institution' => $this->institution_name,'cd' => Crypt::encryptString($this->otpcode)],navigate:true);

        } else {

            $this->resnd = true;

             $this->dispatch('notify',
                        type: 'error',
                        message: $response["message"],
                        position: 'center',
                        timer:3000,
                        button:false
                    );
        }
    }

     public function ResendOtp(){

        $this->validate();

          $email = Crypt::decryptString($this->em); 

          $response = Http::withHeaders([
         ])->post(config('services.api.base_url')."customers/resend-otp", [
            'email' => $email,
            'institution_code' => $this->institution_code
        ])->json();


        if($response['status'] === true) {
           
                   $this->dispatch('notify',
                        type: 'success',
                        message: $response["message"],
                        position: 'center',
                        button:true
                    );

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

}//enclass
