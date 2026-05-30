<?php

use Flux\Flux;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Livewire\Attributes\Layout;
use Livewire\Attributes\On;
use Livewire\Component;

new #[Layout('layouts::app',['title' => 'Buy Data'])] class extends Component
{
    public ?string $token;
    public int $institution_code;
    public string $institution_color;
    public string $institution_colortwo;
    public string $institution_logo;
    public string $institution_name;   
    public string $institution_fullname;  
    
     public int $amount;
     public string $network;
     public string $data_plan;
     public string $phone_number;
     public $transpin = ['','','',''];
     public int $source_account;
     public $accounts = [];
     public string $typedamount;
     public int $step = 1;
     public array $dataplans;
     public string $selectedVariation;
     public string $planName;

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
    public function updateBalance($data = [])
    {
         Log::info('balance updated',$data['data'] ?? []);

        session()->put("accounts-balance",[
                "accounts" => $data['data'] ?? []
            ]);
    }

     public function closeModal($modalname){
        Flux::modal($modalname)->close();
    }

    public function updatedNetwork($value){
        // dd($this->network);
        $networktype = [
            'mtn' => 'mtn-data',
            'airtel' => 'airtel-data',
            '9mobile' => 'etisalat-data',
            'glo' => 'glo-data',
            'smile' => 'smile-direct'
        ];

         $response = Http::withHeaders([
             "content-type" => "application/json",
            "Authorization" => "Bearer ".$this->token
         ])->get(config('services.api.base_url').'transactions/get-databundles/'.$networktype[$value])->json();

     
         if($response["status"] == true){
            $this->dataplans = $response["data"];
         }else{
            $this->dataplans =[];

             $this->dispatch('notify', 
                    title: 'Error',
                    message: "Failed to data plans. Please try again later.",
                    type: 'error'
                );
         }
        
    }

    public function updatedSelectedVariation($value)
{
    $selected = collect($this->dataplans)
        ->firstWhere('variation_code', $value);

    if ($selected) {

        $this->data_plan = $selected['variation_code'];
        $this->planName = $selected['name'];

        $this->amount = $selected['variation_amount'];
    }
}

    public function AccountTodebitTransfer(){

        $this->validate([
            "network" => "required|string",
            'phone_number' => "required|numeric|digits:11"
      ]);

          Flux::modal('selectdebitacct')->show();
    }

    public function AirtimeConfirmDetails(){

           $this->closeModal('selectdebitacct');
             
             $this->step++;
    }
    
     public function ComfirmTransferPin(){

          Flux::modal('confirmpin')->show();
    }

    public function BuyData(){
         $this->validate([
            "transpin.*" => "required|numeric|digits:1",
            'phone_number' => "required|numeric|digits:11"
         ]);

         $response = Http::withHeaders([
            "content-type" => "application/json",
            "Authorization" => "Bearer ".$this->token
       ])->post(config('services.api.base_url').'transactions/buy-data-bundle',[
            'phone_number' => $this->phone_number,
            'amount' => $this->amount,
            'data_plan' => $this->data_plan,
            'network_provider' => $this->network == '9mobile' ? 'etisalat-data' : $this->network,
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
                    'billerno' => $this->phone_number,
                    'billername' => $this->network == '9mobile' ? '9mobile' : str_replace('-data','',$this->network),
                    'type' => 'data',
                    'is_benfi' => true
                 ];

                return $this->redirectRoute('transfer-success',['institution' => $this->institution_name,'data' => Crypt::encrypt($exterra),'ty' => 'data'],navigate:true);

        }else{

         $this->closeModal('confirmpin');

              $this->dispatch('notify', 
                    title: 'Error',
                    message: $response["message"] ?? "Failed to purchase airtime. Please try again later.",
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
        <div x-data="{ open: false,network: @entangle('network'),selected: null,

                    init() {
                        this.setSelected(this.network == '9mobile' ? 'etisalat' : this.network);
                    },

                    setSelected(value) {
                        const map = {
                            mtn: { name: 'MTN', img: '/img/mtn.png' },
                            airtel: { name: 'Airtel', img: '/img/airtel.png' },
                            etisalat: { name: '9mobile', img: '/img/etisalat.png' },
                            glo: { name: 'Glo', img: '/img/glo.png' },
                            smile: { name: 'Smile', img: '/img/smile.png' },
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
                    <span class="text-gray-500 dark:text-white">Select Network</span>
                </template>

            </div>

            <!-- Dropdown -->
            <div x-show="open" @click.outside="open = false" class="absolute left-0 mt-1 w-full bg-white dark:bg-gray-800 dark:text-white border rounded shadow z-50" x-transition >

                <!-- MTN -->
                <div 
                    @click="
                        selected = {name:'MTN', img:'/img/mtn.png'};
                        $wire.set('network', 'mtn');
                        setSelected('mtn');
                        open = false;
                    "
                    class="p-2 flex items-center gap-2 cursor-pointer dark:text-white dark:hover:bg-gray-100 dark:hover:text-gray-800"
                >
                    <img src="/img/mtn.png" class="w-6 h-6"> MTN
                </div>

                <!-- Airtel -->
                <div 
                    @click="
                        selected = {name:'Airtel', img:'/img/airtel.png'};
                        $wire.set('network', 'airtel');
                        setSelected('airtel');
                        open = false;
                    "
                    class="p-2 flex items-center gap-2 cursor-pointer dark:text-white dark:hover:bg-gray-100 dark:hover:text-gray-800"
                >
                    <img src="/img/airtel.png" class="w-6 h-6"> Airtel
                </div>

                <!-- 9mobile -->
                <div 
                    @click="
                        selected = {name:'9mobile', img:'/img/etisalat.png'};
                        $wire.set('network', '9mobile');
                        setSelected('etisalat');
                        open = false;
                    "
                    class="p-2 flex items-center gap-2 cursor-pointer dark:text-white dark:hover:bg-gray-100 dark:hover:text-gray-800"
                >
                    <img src="/img/etisalat.png" class="w-6 h-6"> 9mobile
                </div>

                <!-- Glo -->
                <div 
                    @click="
                        selected = {name:'Glo', img:'/img/glo.png'};
                        $wire.set('network', 'glo');
                        setSelected('glo');
                        open = false;
                    "
                    class="p-2 flex items-center gap-2 cursor-pointer dark:text-white dark:hover:bg-gray-100 dark:hover:text-gray-800"
                >
                    <img src="/img/glo.png" class="w-6 h-6"> Glo
                </div>  
                <!-- Smile -->
                <div 
                    @click="
                        selected = {name:'Smile', img:'/img/smile.png'};
                        $wire.set('network', 'smile');
                        setSelected('smile');
                        open = false;
                    "
                    class="p-2 flex items-center gap-2 cursor-pointer dark:text-white dark:hover:bg-gray-100 dark:hover:text-gray-800"
                >
                    <img src="/img/smile.png" class="w-6 h-6"> Smile
                </div>

            </div>
        </div>

         @error('network')
            {{ $message }}
        @enderror


        <flux:select wire:model.live="selectedVariation">  
                <flux:select.option value="">Select Data Plan</flux:select.option>
                @foreach ($dataplans as $key => $item)
                     <flux:select.option wire:key="variation-{{ $item['variation_code'] }}" value="{{ $item['variation_code'] }}">{{ucwords($item['name'])." - ".number_format($item['variation_amount'],2) }}</flux:select.option>
                @endforeach
        </flux:select>
        <flux:icon.loading wire:loading wire:target="network" class="text-black dark:text-white float-right my-2" />



        <flux:input label="Phone Number" type="text"  maxlength="11" wire:model="phone_number" placeholder="Enter Phone Number" />
    
 

         <div class="space-y-2">
                 <flux:button style="color: white;background-color: {{ $institution_color }}" wire:click="AccountTodebitTransfer"  class="w-full cursor-pointer mt-2">Continue</flux:button>
            </div>
      
               @endif

          @if ($step == 2)
          <flux:heading size="lg">
                    <flux:text class="text-center text-2xl">Comfirm Details</flux:text>
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
                <flux:text class="font-semibold">{{ ucwords(str_replace("-"," ",$network)) }}</flux:text>
            </div> 
            <div class="flex justify-between items-center">
                <flux:text class="text-gray-500">Phone Number</flux:text>
                <flux:text class="font-semibold"> {{ $phone_number }}</flux:text>
            </div> 
            <div class="flex justify-between items-center">
                <flux:text class="text-gray-500">Data Plan</flux:text>
                <flux:text class="font-semibold"> {{ $planName }}</flux:text>
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

                  <flux:button style="color: white; background-color: {{ $institution_color }}" wire:click="AirtimeConfirmDetails"  class="w-full mx-1 cursor-pointer">Continue</flux:button>
            </div>
        </div>
    </div>
</flux:modal>

<flux:modal wire:ignore name="confirmpin" class="md:w-96">
    <div class="space-y-6">
        <div>
            <flux:heading size="lg">Transaction Pin</flux:heading>
        </div>
         
        <flex:text  class="text-gray-500 text-center">Enter Pin</flex:text>
         <div x-data class="flex justify-center mt-4" id="inputs">
                <flux:input type="password" style="text-align: center !important" size="1" maxlength="1" wire:model.live="transpin.0" pattern="[0-9]*" inputmode="numeric" x-ref="p0"  @input="$refs.p1.focus()" class="mx-1 w-12 text-center" />
                <flux:input type="password" style="text-align: center !important" size="1" maxlength="1" wire:model.live="transpin.1" pattern="[0-9]*" inputmode="numeric" x-ref="p1"  @input="$refs.p2.focus()" @keydown.backspace="if (!$event.target.value) {$wire.set('transpin.1', '');$refs.p0.focus();} else {$event.target.value = '';$wire.set('transpin.1', ''); }" class="mx-1 w-12 text-center" />
                <flux:input type="password" style="text-align: center !important" size="1" maxlength="1" wire:model.live="transpin.2" pattern="[0-9]*" inputmode="numeric" x-ref="p2"  @input="$refs.p3.focus()" @keydown.backspace="if (!$event.target.value) {$wire.set('transpin.2', '');$refs.p1.focus();} else {$event.target.value = '';$wire.set('transpin.2', ''); }" class="mx-1 w-12 text-center" />
                <flux:input type="password" style="text-align: center !important" size="1" maxlength="1" wire:model.live="transpin.3" pattern="[0-9]*" inputmode="numeric" x-ref="p3"  @keydown.backspace="if (!$event.target.value) {$wire.set('transpin.3', '');$refs.p2.focus();} else {$event.target.value = '';$wire.set('transpin.3', ''); }" class="mx-1 w-12 text-center" />
        </div>
         <div class="space-y-3 mt-3">
                <flux:button style="color: white; background-color: {{ $institution_color }}" wire:click="BuyData"  class="w-full cursor-pointer">Buy Data</flux:button>
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