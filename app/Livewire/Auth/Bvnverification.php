<?php

namespace App\Livewire\Auth;

use Livewire\Component;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Validate;

class Bvnverification extends Component
{

 #[Validate('required|digits:11|numeric')]
    public string $BvnNumber;

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
    
    #[Layout('layouts::guest',['title' => 'Register New Account'])]
    public function render()
    {
        return view('livewire.auth.bvnverification');
                //->layout('layouts::guest',['title' => 'Register New Account']);

    }

   

   public function VerifyBvnNumber()
    {

        $this->validate();

         $response = Http::withHeaders([
         ])->post("http://localhost:8000/api/bvn/verification", [
            'bvn' => $this->BvnNumber,
            'institution_code' => $this->institution_code
        ])->json();

        Log::info('bvn response',$response);

        if($response['status'] === true) {
            // Handle successful verification
                session()->flash('success', 'BVN verification successful!');
                
             $this->dispatch('bvn-verified',data:[
                'first_name' => $response["data"]["first_name"]
                ])->to(Register::class);

                    $this->reset('BvnNumber');

                return $this->redirectRoute('account.create', ['institution' => $this->institution_name],navigate:true);

                
        } else {
            // Handle verification failure
            session()->flash('error', 'BVN verification failed!');
        }
    }
}
