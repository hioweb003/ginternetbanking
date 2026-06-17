<?php

use Flux\Flux;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Layout;
use Livewire\Attributes\On;
use Livewire\Component;

new #[Layout('layouts::app',['title' => 'Buy Electricity'])] class extends Component
{
    public ?string $token;
    public int $institution_code;
    public string $institution_color;
    public string $institution_colortwo;
    public string $institution_logo;
    public string $institution_name;   
    public string $institution_fullname;  
    
     public int $amount;
     public string $discos;
     public int $meter_number;
     public string $meter_type;
     public int $phone_number;
     public $transpin = ['','','',''];
     public int $source_account;
     public $accounts = [];
     public $verifiedmeter = [];
     public string $typedamount;
     public int $step = 1;
     public string $providerName;

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

public function updatedDiscos($value)
{
    $selected = collect($this->GetElectricityList)
        ->firstWhere('value', $value);

    if ($selected) {

        $this->providerName = $selected['name'];

    }
}

    public function AccountTodebitTransfer(){
        
       $this->validate([
            "discos" => "required|string",
            'meter_number' => "required|numeric|min:11"
      ]);


          Flux::modal('selectdebitacct')->show();
    }

    public function Verifymeter(){
         $this->validate([
            'meter_number' => "required|numeric|min:11"
       ]);

         $response = Http::withHeaders([
             "content-type" => "application/json",
            "Authorization" => "Bearer ".$this->token
         ])->post(config('services.api.base_url').'transactions/verify-meter',[
            "meter_number" => (int)$this->meter_number,
            "service_provider" =>  $this->discos,
            "meter_type" => $this->meter_type
         ])->json();

     
         if($response["status"] == true){
            $this->verifiedmeter = $response["data"];
            $this->step++;
         }else{

             $this->dispatch('notify', 
                    title: 'Error',
                    message: $response["message"] ?? "Failed to verify meter number. Please try again later.",
                    type: 'error'
                );
         }
          
    }

     public function ElectricConfirmDetails(){

           $this->closeModal('selectdebitacct');
             
             $this->step++;
    }
    
     public function ComfirmTransferPin(){

          Flux::modal('confirmpin')->show();
    }

    

    public function BuyElectricity(){
        
             $response = Http::withHeaders([
            "content-type" => "application/json",
            "Authorization" => "Bearer ".$this->token
       ])->post(config('services.api.base_url').'transactions/pay-electricty',[
            'meter_number' => (int)$this->meter_number,
            'phone_number' => (int)$this->phone_number,
            'amount' => (int)$this->amount,
            'service_provider' => $this->discos,
            'meter_type' => $this->meter_type,
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
                    'billerno' => $this->meter_number,
                    'billername' => $this->providerName,
                    'token' => $response["data"]["token"],
                    'unit' => $response["data"]["purchased_units"],
                    'type' => 'bills',
                    'is_benfi' => true
                 ];

                return $this->redirectRoute('transfer-success',['institution' => $this->institution_name,'data' => Crypt::encrypt($exterra),'ty' => 'electricity'],navigate:true);

        }else{

         $this->closeModal('confirmpin');

              $this->dispatch('notify', 
                    title: 'Error',
                    message: $response["message"] ?? "Failed to purchase electricity. Please try again later.",
                    type: 'error'
                );
        }

    }

#[Computed()]
public function GetElectricityList(){

    $eledata_array = [
          [
            "name" =>  "Abuja Electricity Distribution Company (AEDC)",
            "value" => "abuja-electric"
          ],
           [
            "name" =>  "ABA  Electricity Distribution Company (ABA)",
            "value" => "aba-electric"
          ],
          [
            "name" =>  "Enugu Electricity Distribution Company (EEDC)",
            "value" => "enugu-electric"
          ],
          [
            "name" =>  "Eko Electricity Distribution Company (EKEDC)",
            "value" => "eko-electric"
          ],
          [
            "name" =>  "Ikeja Electricity Distribution Company (IKEDC)",
            "value" => "ikeja-electric"
          ],
          [
            "name" =>  "Ibadan Electricity Distribution Company (IBEDC)",
            "value" => "ibadan-electric"
          ],
          [
            "name" => "Jos Electricity Distribution Company (JED)",
            "value" => "jos-electric"
          ],
          [
            "name" => "Benin Electricity Distribution Company (BEDC)",
            "value" => "benin-electric"
          ],
          [
            "name" => "Kano Electricity Distribution Company (KEDCO)",
            "value" =>  "kano-electric"
          ],
          [
            "name" => "Kaduna Electricity Distribution Company (KAEDCO)",
            "value" => "kaduna-electric"
          ],
          [
            "name" => "Port Harcourt Electricity Distribution Company (PHED)",
            "value" => "portharcourt-electric"
          ],
           [
            "name" => "YOLA Electricity Distribution Company (YEDC)",
            "value" => "yola-electric"
          ]
    ];

            return $eledata_array;

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
            <flux:select size="sm" wire:model="meter_type" placeholder="Select Meter Type...">  
                     <flux:select.option value="">Select Meter Type</flux:select.option>
                     <flux:select.option value="prepaid">Prepaid</flux:select.option>
                     <flux:select.option value="postpaid">Postpaid</flux:select.option>
        </flux:select>
        
        <flux:select size="sm" wire:model="discos" placeholder="Select Disco...">  
                     <flux:select.option value="">Select Disco</flux:select.option>
                   @foreach ($this->GetElectricityList() as $item)
                         <flux:select.option value="{{ $item['value'] }}" wire:key="disco-{{ $item['value'] }}">
                             {{ $item['name'] }}
                         </flux:select.option>
                    @endforeach
        </flux:select>

         <flux:input label="Meter Number" wire:model="meter_number" placeholder="Enter Meter Number" />

         <div class="space-y-2">
                 <flux:button style="background-color: {{ $institution_color }};color:#ffffff" wire:click="Verifymeter"  class="w-full cursor-pointer">Verify</flux:button>
            </div>
      
            @endif
            
            @if ($step == 2)


         <div class="bg-gray-100 dark:bg-gray-500 text-black dark:text-white p-2 rounded shadow border-gray-300 mb-3">
                  <div class="flex">
                     <flux:icon.home class="space-y-2 my-3 size-8"/>
                      <div class="ml-3">
                          <flux:text class="text-sm font-bold">{{ucwords($verifiedmeter["meter_name"])}}</flux:text>
                          <flux:text class="text-sm font-bold">{{$providerName}}</flux:text>
                    <div class="flex items-center space-x-2 mt-2">
                        <flux:text class="font-normal">{{ $meter_number }}</flux:text>
                         <flux:separator vertical/>
                        <flux:text class="font-normal"> {{ ucwords($meter_type) }}</flux:text>
                    </div>
                      </div>
                  </div>
             </div>

             <flux:input label="Phone Number" wire:model="phone_number" placeholder="Enter Phone Number" />

             <div class="space-y-2 mb-2">
                        
                         <div x-data="{selectedamount: null,displayValue: @entangle('typedamount'),
                                                formatValue() {
                                    let n = parseFloat(this.displayValue.replace(/,/g, ''));
                                    if (!isNaN(n)) {
                                        this.displayValue = n.toLocaleString('en-US', { minimumFractionDigits: 2, maximumFractionDigits: 2 });
                                    }
                                },
                                unformatValue() {
                                    this.displayValue = this.displayValue.replace(/,/g, '');
                                }
                         }">
                              <flux:input placeholder="Enter Amount" class="w-full my-2" type="text" autocomplete="off"  x-model="displayValue" @blur="formatValue()" @focus="unformatValue()" wire:model.live="typedamount" />
                                  <div class="grid grid-cols-3 gap-2">
                                    <flux:button type="button" @click="selectedamount = (100).toLocaleString('en', { minimumFractionDigits: 2, maximumFractionDigits: 2 }); $wire.typedamount = selectedamount" class="w-full bg-gray-200 dark:bg-gray-700 text-black dark:text-white cursor-pointer">₦100</flux:button>
                                    <flux:button type="button" @click="selectedamount = (200).toLocaleString('en', { minimumFractionDigits: 2, maximumFractionDigits: 2 }); $wire.typedamount = selectedamount" class="w-full bg-gray-200 dark:bg-gray-700 text-black dark:text-white cursor-pointer">₦200</flux:button>
                                    <flux:button type="button" @click="selectedamount = (300).toLocaleString('en', { minimumFractionDigits: 2, maximumFractionDigits: 2 }); $wire.typedamount = selectedamount" class="w-full bg-gray-200 dark:bg-gray-700 text-black dark:text-white cursor-pointer">₦300</flux:button>
                                    <flux:button type="button" @click="selectedamount = (400).toLocaleString('en', { minimumFractionDigits: 2, maximumFractionDigits: 2 }); $wire.typedamount = selectedamount" class="w-full bg-gray-200 dark:bg-gray-700 text-black dark:text-white cursor-pointer">₦400</flux:button>
                                    <flux:button type="button" @click="selectedamount = (500).toLocaleString('en', { minimumFractionDigits: 2, maximumFractionDigits: 2 }); $wire.typedamount = selectedamount" class="w-full bg-gray-200 dark:bg-gray-700 text-black dark:text-white cursor-pointer">₦500</flux:button>
                                    <flux:button type="button" @click="selectedamount = (1000).toLocaleString('en', { minimumFractionDigits: 2, maximumFractionDigits: 2 }); $wire.typedamount = selectedamount" class="w-full bg-gray-200 dark:bg-gray-700 text-black dark:text-white cursor-pointer">₦1,000</flux:button>
                                 </div>
                         </div>
         </div>

         <div class="space-y-2">
                 <flux:button style="background-color: {{ $institution_color }};color:#ffffff" wire:click="AccountTodebitTransfer"  class="w-full cursor-pointer">Continue</flux:button>
            </div>
            @endif

            @if ($step == 3)
                 <flux:heading size="lg">
                    <flux:text class="text-center text-2xl">Confirm Electricity Purchase</flux:text>
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
                    <flux:text class="text-gray-500">Meter Name</flux:text>
                    <flux:text class="font-semibold">{{ucwords($verifiedmeter["meter_name"])  }}</flux:text>
                </div>
                <div class="flex justify-between items-center">
                    <flux:text class="text-gray-500">Type</flux:text>
                    <flux:text class="font-semibold">{{ ucwords($meter_type) }}</flux:text>
                </div>
                <div class="flex justify-between items-center">
                    <flux:text class="text-gray-500">Provider</flux:text>
                    <flux:text class="font-semibold">{{ $providerName }}</flux:text>
                </div>
                <div class="flex justify-between items-center">
                    <flux:text class="text-gray-500"></flux:text>
                    <flux:text class="font-semibold"> {{ $phone_number }}</flux:text>
                </div>
                <flux:separator />

                <div class="flex justify-between items-center">
                    <flux:text class="text-gray-500">Amount</flux:text>
                    <flux:text class="font-semibold">₦{{ number_format($amount, 2) }}</flux:text>
                </div>
            </div>
                
                  <div class="space-y-3 mt-3">
                <flux:button style="color: white; background-color: {{ $institution_color }};color:#ffffff" wire:click="ComfirmTransferPin"  class="w-full cursor-pointer">Confirm</flux:button>
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

                  <flux:button style="color: white; background-color: {{ $institution_color }};color:#ffffff" wire:click="ElectricConfirmDetails"  class="w-full mx-1 cursor-pointer">Continue</flux:button>
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
                <flux:button style="color: white; background-color: {{ $institution_color }};color:#ffffff" wire:click="BuyElectricity"  class="w-full cursor-pointer">Buy Electicity</flux:button>
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