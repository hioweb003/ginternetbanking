<?php

namespace App\Livewire\Auth;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Livewire\Attributes\Layout;
use Livewire\Attributes\On;
use Livewire\Attributes\Validate;
use Livewire\Component;

class Register extends Component
{
    public $institution_code;
    public $institution_color;
    public $institution_logo;
    public $institution_name;
    public $password;
    public $username;
    public $bvn;
    public $first_name;
    public $last_name;
    public $dob;
    public $email;
    public $phone_number;
    public $pin;
    public $gender = "";

    
    #[Validate('required|digits:11|numeric')]
    public $BvnNumber;

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

     
     #[Layout('layouts::guest',['title' => 'Register New Account'])]
    public function render()
    {
        return view('livewire.auth.register');
         //->layout('layouts::guest',['title' => 'Create Account Profile']);
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

}//endclass
