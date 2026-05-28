<?php

namespace App\Livewire\Auth;

use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Validate;
use Livewire\Component;

class Forgetpassword extends Component
{

 public $institution_code;
    public $institution_color;
    public $institution_logo;
    public $institution_name;

    #[Validate('required|string|email:rfc,dns,spoof,filter')]
    public $email;
 
    public function mount(){

          $tenant = app('tenant');

        $this->institution_name = $tenant->name;
        $this->institution_code = $tenant->code;
        $this->institution_color = $tenant->color_one;
        $this->institution_logo = app()->environment('production')
                ? url(env('STORAGE_PATH') . $tenant->logo)
                : asset('storage/' . $tenant->logo);

    }

    #[Layout('layouts::guest',['title' => 'Forget Password'])]
    public function render()
    {
        return view('livewire.auth.forgetpassword');
        //->layout('layouts::guest',['title' => 'Forget Password']);
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
}//endclass
