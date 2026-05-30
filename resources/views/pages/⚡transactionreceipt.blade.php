<?php

use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Http;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Url;
use Livewire\Component;

new #[Layout('layouts::app',['title' => 'Transaction Receipt'])] class extends Component
{
    public ?string $token;
    public string $institution_code;
    public string $institution_color;
    public string $institution_colortwo;
    public string $institution_logo;
    public string $institution_name;   
    public string $institution_fullname;  
   
     #[Url(history: true)]
    public string $ref;

    public array $receipt;

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

        $this->GetReceipt();

    }

     public function GetReceipt(){

        $ref =  Crypt::decryptString($this->ref); 

        $response = Http::withHeaders([
            "content-type" => "application/json",
            "Authorization" => "Bearer ".$this->token
        ])->get(config('services.api.base_url').'transactions/transaction_receipt/'.$ref);


        if($response['status'] == true){
              $this->receipt = $response['data'] ?? [];
        }else{
          
             $this->dispatch('notify', 
                    title: 'Error',
                    message: 'Failed to fetch beneficiary banks. Please try again later.',
                    type: 'error'
                );
        }
    }

    public function DownloadReciept(){
            
            $ref =  Crypt::decryptString($this->ref);

              $resp = Http::withHeaders([
                          "content-type" => "application/json",
                         "Authorization" => "Bearer ".$this->token
                    ])->get(config('services.api.base_url')."transactions/download-transaction-recipt",[
                       'trnxid' => $ref,
                    ])->json();


        if(isset($resp['code']) && $resp['code'] == '401'){
                auth()->logout();
                    session()->flush();

                    return $this->redirectRoute('home',['institution' => $this->institution_name],navigate:true);
            }


       
        if($resp["status"] == true){ 

                  $base64 = $resp["data"];

                if (str_contains($base64, 'base64,')) {
                    [$meta, $base64] = explode(',', $base64, 2);
                }

                $fileContent = base64_decode($base64);

                $filename = 'transaction_reciept.pdf';

                return response()->streamDownload(function () use ($fileContent) {
                        echo $fileContent;
                    },
                    $filename,
                    [
                        'Content-Type' => 'application/pdf,',
                    ]
                );

        }
    }

    
};
?>

<div>
    <!-- Content -->
        <main class="p-2 md:p-4 space-y-6 flex-1">
            <div class="py-10 flex items-center justify-center">

    <flux:card id="receipt" class="space-y-3 mx-auto w-full max-w-md lg:max-w-xl p-6 text-center shadow-xl rounded-2xl bg-white relative">

        <!-- 🔷 LOGO SECTION -->
        <div class="flex flex-col items-center">
            <img 
                src="{{ $institution_logo }}" 
                alt="Company Logo" 
                class="h-12 mb-2 object-contain"
            >
         
        </div>

        <!-- Divider -->
        <div class="border-t"></div>

        <!-- Header -->
        <div>
            <h2 class="text-2xl font-bold text-gray-800">Transaction Receipt</h2>
        </div>

        <!-- Amount -->
        <div>
            <p class="text-gray-500 text-sm">Amount</p>
            <h1 class="text-3xl font-bold {{$receipt['type'] == 'credit' || $receipt['type'] == 'deposit' ? 'text-green-500' : 'text-red-500'}}">{{$receipt['type'] == 'credit' || $receipt['type'] == 'deposit' ? '+' : '-'}} ₦{{ number_format($receipt['amount'], 2) }}</h1>
        </div>

        <!-- Details -->
        <div class="text-left space-y-6">

            <div class="flex justify-between">
                <span class="text-gray-500">Transaction ID</span>
                <span class="font-medium text-gray-500" style="word-break: break-all !important">{{$receipt['reference_no']}}</span>
            </div>

            @php
                $beneficiary = explode('-',$receipt['beneficiary']);
            @endphp
            <div class="flex justify-between">
                <span class="text-gray-500">Date</span>
                <span class="font-medium text-gray-500">{{date('M d, Y',strtotime($receipt['created_at']))}}</span>
            </div>

            <div class="flex justify-between">
                <span class="text-gray-500">Time</span>
                <span class="font-medium text-gray-500">{{date('h:i A',strtotime($receipt['created_at']))}}</span>
            </div>


            <div class="flex justify-between">
                <span class="text-gray-500">Sender</span>
                <span class="font-medium text-gray-500">
                    @if($receipt['type'] == 'credit' || $receipt['type'] == 'deposit')
                        @if(isset($beneficiary[0]))
                            {{ ucwords($beneficiary[0]) }} {{ isset($beneficiary[1]) ? " | " . $beneficiary[1] : "" }}
                        @else
                            {{ ucwords(session('details')['name'] ?? '') }}
                        @endif
                    @else
                        {{ ucwords(session('details')['name'] ?? '') }}
                    @endif
                </span>
            </div>

          
            <div class="flex justify-between">
                <span class="text-gray-500">Receiver</span>
                <span class="font-medium text-gray-500">
                      {{
                        $receipt['type'] == 'credit' || $receipt['type'] == 'deposit'
                            ? ucwords(session('details')['name'] ?? '')
                            : (
                                isset($beneficiary[0], $beneficiary[1])
                                    ? ucwords($beneficiary[0]) . ' | ' . $beneficiary[1]
                                    : ''
                            )
                    }}
                </span>
            </div>
          
            @isset($beneficiary[2])
                  <div class="flex justify-between">
                <span class="text-gray-500">Bank</span>
                <span class="font-medium text-gray-500">{{ucwords($beneficiary[2])}}</span>
            </div>
            @endisset
          

            <div class="flex justify-between">
                <span class="text-gray-500">Transaction Type</span>
                <span class="{{$receipt['type'] == 'credit' || $receipt['type'] == 'deposit' ? 'text-green-500' : 'text-red-500'}} font-semibold">
                    {{ $receipt['type'] == 'credit' || $receipt['type'] == 'deposit' ? 'Credit' : 'Debit'}}
                </span>
            </div> 
            
            <div class="flex justify-between">
                <span class="text-gray-500">Status</span>
                <span class="{{$receipt["status"] == "approved" ? 'text-green-500' : ($receipt["status"] == "processing" ? 'text-yellow-400' : 'text-red-500')}} font-semibold">
                    {{ $receipt["status"] == "approved" ? 'Success' : ($receipt["status"] == "processing" ? 'Processing' : $receipt["status"])}}
                </span>
            </div>

        </div>

        <!-- Divider -->
        <div class="border-t"></div>

        <!-- Footer -->
        <div class="text-xs text-gray-400">
            Powered by {{ ucwords($institution_fullname) }} • Secure Payment
        </div>

        <!-- Download Button -->
        {{-- <a 
             href="{{ route('dwolodrecpt',['institution' => $institution_name,'recept' => Crypt::encryptString(json_encode($receipt))]) }}"
            class="w-full bg-linear-to-r py-2 rounded-lg text-white hover:bg-gray-800 transition cursor-pointer block"
            style="background: linear-gradient(to right, {{ $institution_color  }}, {{ $institution_colortwo }});"
        >
           Download Receipt 
        </a> --}}
        <flux:button wire:click.prevent='DownloadReciept' class="w-full bg-linear-to-r py-2 rounded-lg text-white hover:bg-gray-800 transition cursor-pointer block"
            style="background: linear-gradient(to right, {{ $institution_color  }}, {{ $institution_colortwo }});color: white;">Download Receipt</flux:button>

    </flux:card>
</div>

        </main>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>

<script>
window.downloadReceipt = async function () {

    const original = document.getElementById('receipt');

    if (!original) {
        alert('Receipt not found');
        return;
    }

    // 🔥 Clone the receipt
    const clone = original.cloneNode(true);

    // 🔥 Reset ALL styles to safe values
    clone.querySelectorAll('*').forEach(el => {
        el.style.backgroundColor = '#ffffff';
        el.style.color = '#000000';
        el.style.borderColor = '#dddddd';
    });

    clone.style.backgroundColor = '#ffffff';
    clone.style.color = '#000000';

    // Put clone offscreen
    clone.style.position = 'fixed';
    clone.style.top = '-9999px';
    document.body.appendChild(clone);

    // Render clean version
    const canvas = await html2canvas(clone, {
        backgroundColor: '#ffffff',
        useCORS: true
    });

    document.body.removeChild(clone);

    const imgData = canvas.toDataURL('image/png');

    const { jsPDF } = window.jspdf;

    const pdf = new jsPDF({
        orientation: 'portrait',
        unit: 'px',
        format: [canvas.width, canvas.height]
    });

    pdf.addImage(imgData, 'PNG', 0, 0, canvas.width, canvas.height);

    pdf.save('receipt.pdf');
};
</script>