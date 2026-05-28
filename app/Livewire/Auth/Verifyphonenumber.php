<?php

namespace App\Livewire\Auth;

use Livewire\Attributes\Layout;
use Livewire\Component;

class Verifyphonenumber extends Component
{

    public $institution_code;
    public $institution_color;
    public $institution_logo;
    public $institution_name;
 
    public function mount(){

          $tenant = app('tenant');

        $this->institution_name = $tenant->name;
        $this->institution_code = $tenant->code;
        $this->institution_color = $tenant->color_one;
        $this->institution_logo = app()->environment('production')
                ? url(env('STORAGE_PATH') . $tenant->logo)
                : asset('storage/' . $tenant->logo);

    }

    #[Layout('layouts::guest',['title' => 'Verify Phone Number'])]
    public function render()
    {
        return view('livewire.auth.verifyphonenumber');
         //->layout('layouts::guest',['title' => 'Verify Phone Number']);
    }
}
