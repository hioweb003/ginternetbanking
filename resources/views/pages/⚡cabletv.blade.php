<?php

use Flux\Flux;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Livewire\Attributes\Layout;
use Livewire\Attributes\On;
use Livewire\Component;

new #[Layout('layouts::app',['title' => 'Cable Tv'])] class extends Component
{
    public ?string $token;
    public int $institution_code;
    public string $institution_color;
    public string $institution_colortwo;
    public string $institution_logo;
    public string $institution_name;   
    public string $institution_fullname;  
    
     public int $amount;
     public int $smartcard_number;
     public string $cable;
     public string $cable_plan;
     public string $phone_number;
     public $transpin = ['','','',''];
     public int $source_account;
     public $accounts = [];
     public $verifiedcard = [];
     public string $typedamount;
    public int $step = 1;
    public array $cableplans;
     public string $selectedVariation;
     public string $cableName;
     public bool $showmaxbtn = false;

    public function mount(){

        $this->institution_name = app('tenant')->name;
        $this->institution_fullname = app('tenant')->fullname;
        $this->institution_code = app('tenant')->code;
        $this->institution_color = app('tenant')->color_one;
        $this->institution_colortwo = app('tenant')->color_two;
        $this->institution_logo = app()->environment('production')
                ? url(env('STORAGE_PATH') . app('tenant')->logo)
                : asset('storage/' . app('tenant')->logo);

       $this->token = session('access_token');
       $expiresAt = session('access_token_expires_at');

        if (!$this->token || now()->greaterThan($expiresAt)) {
            auth()->logout();
            session()->flush();

            return $this->redirectRoute('home',['institution' => $this->institution_name],navigate:true);
        }

        $this->accounts = session('accounts-balance')['accounts'];
    }

    public function updatedTypedamount($value)
    {
        $this->amount = floatval(str_replace(',', '', $value));
    } 

     public function nextstep()
    {
        $this->step++;
    } 

     public function prevstep()
    {
        $this->step--;
    }

      #[On('balance-loaded')]      
    public function updateBalance($data)
    {
         Log::info('balance updated',$data['data']);

        session()->put("accounts-balance",[
                "accounts" => $data['data']
            ]);
    }

     public function closeModal($modalname){
        Flux::modal($modalname)->close();
    }

 public function updatedCable($value){
     
         $response = Http::withHeaders([
             "content-type" => "application/json",
            "Authorization" => "Bearer ".$this->token
         ])->get(config('services.api.base_url').'transactions/get-subcriptions?service_type='.$value)->json();

     
         if($response["status"] == true){
            $this->cableplans = $response["data"];
            // $this->showmaxbtn = $value == "showmax" ? true : false;
         }else{
            $this->cableplans =[];

             $this->dispatch('notify', 
                    title: 'Error',
                    message: "Failed to cabletv plans. Please try again later.",
                    type: 'error'
                );
         }
        
    }

public function updatedSelectedVariation($value)
{
    $selected = collect($this->cableplans)
        ->firstWhere('variation_code', $value);

    if ($selected) {

        $this->cable_plan = $selected['variation_code'];
        $this->cableName = $selected['name'];

        $this->amount = $selected['variation_amount'];
    }
}

    public function AccountTodebitTransfer(){

        $this->validate([
            "cable" => "required|string",
            "cable_plan" => "required|string",
            'phone_number' => "required|numeric|digits:11"
      ]);

          Flux::modal('selectdebitacct')->show();
    }

     public function VerifySmartcard(){

         $this->validate([
            "smartcard_number" => "required|numeric",
            "cable" => "required|string"
         ]);

        $response = Http::withHeaders([
             "content-type" => "application/json",
            "Authorization" => "Bearer ".$this->token
         ])->post(config('services.api.base_url').'transactions/verify-smartcard',[
             "smartcard_number" => (int)$this->smartcard_number,
            "service_type" => $this->cable
         ])->json();

     
         if($response["status"] == true){
            $this->verifiedcard = $response["data"];
            $this->step++;
         }else{
            $this->cableplans =[];

             $this->dispatch('notify', 
                    title: 'Error',
                    message: "Failed to verify cabletv. Please try again later.",
                    type: 'error'
                );
         }
             
             
    } 
    
    public function CableConfirmDetails(){

           $this->closeModal('selectdebitacct');
             
             $this->step++;
    }
    
     public function ComfirmTransferPin(){

          Flux::modal('confirmpin')->show();
    }

    public function BuyCable(){
         $this->validate([
            "smartcard_number" => "required|numeric",
            "cable" => "required|string",
            "cable_plan" => "required|string",
            'phone_number' => "required|numeric|digits:11",
            "transpin.*" => "required|numeric|digits:1",
         ]);
     

         $response = Http::withHeaders([
            "content-type" => "application/json",
            "Authorization" => "Bearer ".$this->token
       ])->post(config('services.api.base_url').'transactions/pay-cabletv-subcription',[
            'smartcard_number' => $this->smartcard_number,
            'phone' => $this->phone_number,
            'amount' => $this->amount,
            'service_type' => $this->cable,
            'subcription_plan' => $this->cable_plan,
            'pin' => implode("", $this->transpin),
            'platform' => "web",
            'source_account' => $this->source_account,
            'institution_code' => $this->institution_code
        ])->json();
   

         if(isset($response['code']) && $response['code'] == '401'){
             auth()->logout();
                session()->flush();

                return $this->redirectRoute('home',['institution' => $this->institution_name],navigate:true);
        }

        if($response["status"] == true){

              $this->closeModal('confirmpin');
              
                 $this->dispatch('balance-refresh');

                $exterra = [
                    'ref' => $response["reference"],
                    'billerno' => $this->smartcard_number,
                    'billername' => $this->cableName,
                    'type' => 'cable',
                    'is_benfi' => true
                 ];
                
                return $this->redirectRoute('transfer-success',['institution' => $this->institution_name,'data' => Crypt::encrypt($exterra),'ty' => 'data'],navigate:true);

        }else{

         $this->closeModal('confirmpin');

              $this->dispatch('notify', 
                    title: 'Error',
                    message: $response["message"] ?? "Failed to purchase cableTv. Please try again later.",
                    type: 'error'
                );
        }
    }
};
?>

<div>
    <!-- Content -->
        <main class="p-2 md:p-4 space-y-6 flex-1">
        
            <flux:card class="space-y-6 mx-auto mt-8 w-full max-w-md lg:max-w-xl">

    <div>
        <flux:heading size="lg">
                 <flux:button size="sm" href="{{ route('dashboard',['institution' => $institution_name]) }}"  wire:navigate.hover icon="arrow-left" variant="outline" inset />
        </flux:heading>
    </div>

    <div class="space-y-6">
        
        @if ($step == 1)
          <div x-data="{ open: false,cable: @entangle('cable'),selected: null,

                    init() {
                        this.setSelected(this.cable);
                    },

                    setSelected(value) {
                        const map = {
                            dstv: { name: 'Dstv', img: '/img/dstv.png' },
                            gotv: { name: 'Gotv', img: '/img/gotv.jpeg' },
                            startimes: { name: 'Startimes', img: '/img/startimes.jpg' },
                            showmax: { name: 'Showmax', img: '/img/showmax.png' },
                        };

                        this.selected = map[value] ?? null;
                    }
                }"
                x-init="init()"
              class="relative w-full" >

            <!-- Trigger -->
            <div  @click="open = !open"  class="border p-2 rounded cursor-pointer flex items-center gap-2 bg-white dark:bg-gray-800 dark:text-white">

                <!-- Selected -->
                <template x-if="selected">
                    <div class="flex items-center gap-2">
                        <img :src="selected.img" class="w-5 h-5">
                        <span x-text="selected.name"></span>
                    </div>
                </template>

                <!-- Placeholder -->
                <template x-if="!selected">
                    <span class="text-gray-500 dark:text-white">Select CableTv</span>
                </template>

            </div>

            <!-- Dropdown -->
            <div x-show="open" @click.outside="open = false" class="absolute left-0 mt-1 w-full bg-white dark:bg-gray-800 dark:text-white border rounded shadow z-50" x-transition >
                <!--dstv -->
                <div 
                    @click="
                        selected = {name:'Dstv', img:'/img/dstv.png'};
                        $wire.set('cable', 'dstv');
                        setSelected('dstv');
                        open = false;
                    "
                    class="p-2 flex items-center gap-2 cursor-pointer dark:text-white dark:hover:bg-gray-100 dark:hover:text-gray-800"
                >
                    <img src="/img/dstv.png" class="w-6 h-6"> Dstv
                </div>

                <!-- gotv -->
                <div 
                    @click="
                        selected = {name:'gotv', img:'/img/gotv.jpeg'};
                        $wire.set('cable', 'gotv');
                        setSelected('gotv');
                        open = false;
                    "
                    class="p-2 flex items-center gap-2 cursor-pointer dark:text-white dark:hover:bg-gray-100 dark:hover:text-gray-800"
                >
                    <img src="/img/gotv.jpeg" class="w-6 h-6"> Gotv
                </div>

                <!-- Startimes -->
                <div 
                    @click="
                        selected = {name:'Startimes', img:'/img/startimes.jpg'};
                        $wire.set('cable', 'startimes');
                        setSelected('startimes');
                        open = false;
                    "
                    class="p-2 flex items-center gap-2 cursor-pointer dark:text-white dark:hover:bg-gray-100 dark:hover:text-gray-800"
                >
                    <img src="/img/startimes.jpg" class="w-6 h-6"> Startimes
                </div>  
                <!-- Showmax -->
                {{-- <div 
                    @click="
                        selected = {name:'Showmax', img:'/img/showmax.png'};
                        $wire.set('cable', 'showmax');
                        setSelected('showmax');
                        open = false;
                    "
                    class="p-2 flex items-center gap-2 cursor-pointer dark:text-white dark:hover:bg-gray-100 dark:hover:text-gray-800"
                >
                    <img src="/img/showmax.png" class="w-6 h-6"> Showmax
                </div> --}}

            </div>
        </div>

         @error('cable')
            {{ $message }}
        @enderror

                <flux:input label="Smartcard Number" wire:model="smartcard_number" placeholder="Enter Smartcard Number" />

         <div class="space-y-2">
                 <flux:button style="background-color: {{ $institution_color }}" wire:click="VerifySmartcard"  class="w-full cursor-pointer">Verify</flux:button>
            </div>
     @endif

        @if ($step == 2)

         <div class="bg-gray-100 dark:bg-gray-500 text-black dark:text-white p-2 rounded shadow border-gray-300 mb-3">
                  <div class="flex">
                     <flux:icon.home class="space-y-2 my-3 size-8"/>
                      <div class="ml-3">
                          <flux:text class="text-sm font-bold">{{ucwords($verifiedcard["Customer_Name"])}}</flux:text>
                    <div class="flex items-center space-x-2 mt-2">
                        <flux:text class="font-normal">{{ $smartcard_number }}</flux:text>
                         <flux:separator vertical/>
                        <flux:text class="font-normal"> {{ ucwords($cable) }}</flux:text>
                    </div>
                      </div>
                  </div>
             </div>

          <flux:select wire:model.live="selectedVariation">  
                <flux:select.option value="">Select CableTv Package</flux:select.option>
                @foreach ($cableplans as $key => $item)
                     <flux:select.option wire:key="variation-{{ $item['variation_code'] }}" value="{{ $item['variation_code'] }}">{{ucwords($item['name'])." - ".number_format($item['variation_amount'],2) }}</flux:select.option>
                @endforeach
        </flux:select>
        <flux:icon.loading wire:loading wire:target="cable" class="text-black dark:text-white float-right my-2" />

        <flux:input label="Phone Number" wire:model="phone_number" placeholder="Enter Phone Number" />
        

         <div class="space-y-2">
                 <flux:button style="background-color: {{ $institution_color }}" wire:click="AccountTodebitTransfer"  class="w-full cursor-pointer">Continue</flux:button>
            </div>
      
              @endif

            @if ($step == 3)
                <flux:heading size="lg">
                    <flux:text class="text-center text-2xl">Comfirm Cable TV Details</flux:text>
            </flux:heading>

         
          <div class="space-y-6 rounded">
               <div class="flex justify-between items-center">
                <flux:text class="text-gray-500">From</flux:text>
                <flux:text class="font-semibold"></flux:text>
            </div>
             <div class="flex justify-between items-center">
                <flux:text class="text-gray-500">Bank</flux:text>
                <flux:text class="font-semibold">{{ucwords($institution_fullname)}}</flux:text>
            </div>  
            <div class="flex justify-between items-center">
                <flux:text class="text-gray-500">{{ucwords(session('details')['name'] ?? "")}}</flux:text>
                <flux:text class="font-semibold">{{$source_account}}</flux:text>
            </div>
            <flux:separator />

            <div class="flex justify-between items-center">
                <flux:text class="text-gray-500">To</flux:text>
                <flux:text class="font-semibold"></flux:text>
            </div>
               <div class="flex justify-between items-center">
                <flux:text class="text-gray-500">Provider</flux:text>
                <flux:text class="font-semibold"> {{ ucwords(str_replace("-"," ",$cable)) }}</flux:text>
            </div>  
             <div class="flex justify-between items-center">
                <flux:text class="text-gray-500">Phone Number</flux:text>
                <flux:text class="font-semibold"> {{ $phone_number }}</flux:text>
            </div> 
            <div class="flex justify-between items-center">
                <flux:text class="text-gray-500">Package</flux:text>
                <flux:text class="font-semibold"> {{ $cableName }}</flux:text>
            </div>
            <flux:separator />

            <div class="flex justify-between items-center">
                <flux:text class="text-gray-500">Amount</flux:text>
                <flux:text class="font-semibold">₦{{ number_format($amount, 2) }}</flux:text>
            </div>
          </div>

              <div class="space-y-3 mt-3">
                <flux:button style="color: white; background-color: {{ $institution_color }}" wire:click="ComfirmTransferPin"  class="w-full cursor-pointer">Confirm</flux:button>
             <flux:button   wire:click="prevstep"  variant="filled" class="w-full cursor-pointer" :loading="false">Back</flux:button>

            </div>
            @endif
    </div>
</flux:card>

        

            <flux:modal wire:ignore name="selectdebitacct" class="md:w-96">
    <div class="space-y-6">
        <div>
            <flux:heading size="lg">Select Account To Debit</flux:heading>
            {{-- <flux:text class="mt-2">Make changes to your personal details.</flux:text> --}}
        </div>

        <div class="space-y-6 rounded">
            
                <flux:select size="sm" wire:model="source_account" placeholder="Select account to debit...">  
                     <flux:select.option value="">Select</flux:select.option>
                     @foreach ($accounts as $key => $item)
                          <flux:select.option value="{{ $item['account_number'] }}">{{ucwords($item['name'])." - ".$item['account_number'] }} ({{ number_format($item['balance'],2) }})</flux:select.option>
                       @endforeach
                </flux:select>

               <div class="flex justify-between items-center">
                     <flux:button  wire:click="closeModal('selectdebitacct')" variant="filled" class="w-full mx-1 cursor-pointer" :loading="false">Cancel</flux:button>

                  <flux:button style="color: white; background-color: {{ $institution_color }}" wire:click="CableConfirmDetails"  class="w-full mx-1 cursor-pointer">Continue</flux:button>
            </div>
        </div>
    </div>
</flux:modal>


<flux:modal wire:ignore name="confirmpin" class="md:w-96">
    <div class="space-y-6">
        <div>
            <flux:heading size="lg">Confirm Transaction</flux:heading>
        </div>
         
        <flex:text  class="text-gray-500 text-center">Transaction Pin</flex:text>
         <div x-data class="flex justify-center mt-4" id="inputs">
                <flux:input type="password" style="text-align: center !important" size="1" maxlength="1" wire:model.live="transpin.0" pattern="[0-9]*" inputmode="numeric" x-ref="p0"  @input="$refs.p1.focus()" class="mx-1 w-12 text-center" />
                <flux:input type="password" style="text-align: center !important" size="1" maxlength="1" wire:model.live="transpin.1" pattern="[0-9]*" inputmode="numeric" x-ref="p1"  @input="$refs.p2.focus()" @keydown.backspace="if (!$event.target.value) {$wire.set('transpin.1', '');$refs.p0.focus();} else {$event.target.value = '';$wire.set('transpin.1', ''); }" class="mx-1 w-12 text-center" />
                <flux:input type="password" style="text-align: center !important" size="1" maxlength="1" wire:model.live="transpin.2" pattern="[0-9]*" inputmode="numeric" x-ref="p2"  @input="$refs.p3.focus()" @keydown.backspace="if (!$event.target.value) {$wire.set('transpin.2', '');$refs.p1.focus();} else {$event.target.value = '';$wire.set('transpin.2', ''); }" class="mx-1 w-12 text-center" />
                <flux:input type="password" style="text-align: center !important" size="1" maxlength="1" wire:model.live="transpin.3" pattern="[0-9]*" inputmode="numeric" x-ref="p3"  @keydown.backspace="if (!$event.target.value) {$wire.set('transpin.3', '');$refs.p2.focus();} else {$event.target.value = '';$wire.set('transpin.3', ''); }" class="mx-1 w-12 text-center" />
        </div>
         <div class="space-y-3 mt-3">
                <flux:button style="color: white; background-color: {{ $institution_color }}" wire:click="BuyCable"  class="w-full cursor-pointer">Subcribe</flux:button>
             <flux:button  wire:click="closeModal('confirmpin')" variant="filled" class="w-full cursor-pointer" :loading="false">Cancel</flux:button>

            </div>   
         
    </div>
</flux:modal>

        </main>
</div>

<script>
    window.addEventListener('balance-refresh', async () => {
        let baseurl = "{{ config('services.api.base_url') }}";
        let token = "{{ $token }}";

    let response = await fetch(baseurl+'customers/customer/get-balance',{
           method: 'GET',
            headers: {
                'Content-Type': 'application/json',
                'Accept': 'application/json',
                'Authorization': 'Bearer ' + token
            }
    });
    let data = await response.json();

    // 🔥 IMPORTANT: send as ONE payload
    Livewire.dispatch('balance-loaded', data);

});
</script>