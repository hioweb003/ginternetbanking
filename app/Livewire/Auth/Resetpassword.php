<?php

namespace App\Livewire\Auth;

use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Url;
use Livewire\Attributes\Validate;
use Livewire\Component;

class Resetpassword extends Component
{

 public $institution_code;
    public $institution_color;
    public $institution_logo;
    public $institution_name;

    #[Validate('required|string|min:8')]
    public $password;

     #[Url(history: true)]
    public $code;
 
    public function mount(){

        $tenant = app('tenant');

        $this->institution_name = $tenant->name;
        $this->institution_code = $tenant->code;
        $this->institution_color = $tenant->color_one;
        $this->institution_logo = app()->environment('production')
                ? url(env('STORAGE_PATH') . $tenant->logo)
                : asset('storage/' . $tenant->logo);


    }

    #[Layout('layouts::guest',['title' => 'Reset Password'])]
    public function render()
    {
        return view('livewire.auth.resetpassword');
        //->layout('layouts::guest',['title' => 'Reset Password']);
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
}
