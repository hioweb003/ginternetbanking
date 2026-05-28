<?php

use Livewire\Component;

new class extends Component
{
    public $saveType;
    public $modelval;
    
       public function mount($saveType,$modelval){
            $this->saveType = $saveType;
            $this->modelval = $modelval;
        }

};
?>

<div>
   
</div>