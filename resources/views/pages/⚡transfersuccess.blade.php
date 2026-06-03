<?php

use Illuminate\Contracts\Encryption\DecryptException;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Http;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Url;
use Livewire\Component;

new #[Layout('layouts::app',['title' => 'Success page'])] class extends Component
{
    public ?string $token;
    public string $institution_code;
    public string $institution_color;
    public string $institution_colortwo;
    public string $institution_logo;
    public string $institution_name;   
    public string $institution_fullname;  
    
    #[Url(as: 'data',history: true)]
    public ?string $data = null;
    
    #[Url(history: true)]
    public string $ty ="";

    public string $bankcode;
    public string $bankname;
    public string $accountno;
    public string $accountname;
    public string $reference; 
    public string $billerno;
    public string $billername;
    public string $eletoken;
    public string $unit;
    public string $type;              
    public bool $isbenfi;


    public array $messages =[
        "data" => "Your data puchase was completed successfully.",
        "airtime" => "Your airtime puchase was completed successfully.",
        "cable" => "Your cable Tv subcription is completed successfully.",
        "electricity" => "Your puchase of electricity was completed successfully.",
        "transfer" => "Your transfer was completed successfully."
    ]; 

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

       // 1. Check if the URL data parameter is completely empty
    if (empty($this->data)) {
        // Handle gracefully: Redirect away or initialize empty defaults
        return redirect()->route('dashboard')->with('error', 'Invalid reference payload.');
    }

    try {
        // 2. Attempt to decrypt the data safely
        $dataa = Crypt::decrypt($this->data);

        // 3. Assign properties only if decryption succeeds
        if (is_array($dataa)) {
            $this->reference = isset($dataa['ref']) ? Crypt::encryptString($dataa['ref']) : "";
            $this->bankcode = $dataa["bankcode"] ?? "";
            $this->bankname = $dataa['bankname'] ?? "";
            $this->accountno = $dataa['accountno'] ?? "";
            $this->accountname = $dataa['accountname'] ?? "";
            $this->billerno = $dataa['billerno'] ?? "";
            $this->billername = $dataa['billername'] ?? "";
            $this->eletoken = $dataa['token'] ?? "";
            $this->unit = $dataa['unit'] ?? "";
            $this->type = $dataa['type'] ?? "";
            $this->isbenfi = $dataa['is_benfi'] ?? false;
        }
    } catch (DecryptException $e) {
        // 4. Catch tampered or expired encrypted payloads instead of crashing
        return redirect()->route('dashboard')->with('error', 'Session reference expired.');
    }

    }

    

    public function SaveBeneficiary(){
        
       
       $response = Http::withHeaders([
            "content-type" => "application/json",
            "Authorization" => "Bearer ".$this->token
        ])->post(config('services.api.base_url').'customers/beneficiary/add',[
            'account_name' => $this->accountname,
             'account_number' => $this->accountno,
             'bank_name' => $this->bankname,
             'bank_code' => $this->bankcode,
             'biller_number' => $this->billerno,
             'biller_name' => $this->billername,
             'type' => $this->type,
             'branch_id' => $this->institution_code
        ]);

        if(isset($response['code']) && $response['code'] == '401'){
             auth()->logout();
                session()->flush();

                return $this->redirectRoute('home',['institution' => $this->institution_name],navigate:true);
        }

          if($response["status"] == true){

             $this->dispatch('notify', 
                    title: 'Success',
                    message: $response["message"] ?? "Beneficiary saved.",
                    type: 'success'
                );
        }else{

             $this->dispatch('notify', 
                    title: 'Error',
                    message: $response["message"] ?? "Failed to save beneficiary.",
                    type: 'error'
                );
        }
    }


};
?>

<div>
  <!-- Content -->
        <main class="p-2 md:p-4 space-y-6 flex-1">

    <div class="flex items-center justify-center my-40 bg-gray-50 dark:bg-gray-900">

    <flux:card class="space-y-6 mx-auto w-full max-w-md lg:max-w-xl text-center">

        <!-- ICON -->
        <div class="flex justify-center">
            <div class="w-16 h-16 rounded-full bg-green-100 dark:bg-green-900 flex items-center justify-center">
                <span class="text-3xl text-green-600 dark:text-green-400">
                    <flux:icon.check />
                </span>
            </div>
        </div>

        <!-- TITLE -->
        <flux:heading size="lg" class="text-green-600 dark:text-green-400">
            Transaction Completed
        </flux:heading>

        <!-- MESSAGE -->
        <flux:text class="text-gray-600 dark:text-gray-300">
            {{ $messages[$ty] }}
        </flux:text>

   

        <!-- BUTTON -->
       <div class="flex gap-3 pt-4">

            <flux:button href="{{ route('trxreceipt',['institution' => $institution_name,'ref' => $reference]) }}" wire:navigate.hover variant="primary" class="w-full cursor-pointer">
               Transaction Receipt
            </flux:button>

                 <a href="{{ route('dashboard',['institution' => $institution_name]) }}" wire:navigate  variant="ghost" class="w-full cursor-pointer">
                Go Home
            </a>

        </div>

        <div class="flex justify-center mt-2">
               <flux:button wire:click.prevent='SaveBeneficiary' variant="ghost" class="w-full cursor-pointer">
               Save Beneficiary
            </flux:button>
        </div>
         

    </flux:card>

</div>
        </main>
  

</div>