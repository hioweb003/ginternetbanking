<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Transaction Receipt</title>

    <style>
        body {
            font-family: DejaVu Sans, sans-serif;
            background: #f5f5f5;
            padding: 20px;
        }

        .container {
            width: 100%;
            max-width: 500px;
            margin: 0 auto;
        }

        .card {
            background: #ffffff;
            padding: 25px;
            border-radius: 12px;
            border: 1px solid #ddd;
            text-align: center;
            position: relative;
             overflow: hidden;
        }

    .watermark-text {
        position: fixed;
        top: 45%;
        left: 10%;
        font-size: 60px;
        color: #000;
        opacity: 0.05;
        transform: rotate(-30deg);
        z-index: -1;
        font-weight: bold;
        white-space: nowrap;
    }

      .wm1 { top: 5%; left: 5%; }
    .wm2 { top: 5%; right: 5%; }

    .wm3 { top: 20%; left: 30%; }
    .wm4 { top: 35%; right: 30%; }

    .wm5 { top: 50%; left: 10%; }
    .wm6 { top: 55%; right: 10%; }

    .wm7 { top: 60%; left: 40%; }

        .logo img {
            height: 50px;
            margin-bottom: 10px;
        }

        .divider {
            border-top: 1px solid #e5e5e5;
            margin: 15px 0;
        }

        .title {
            font-size: 20px;
            font-weight: bold;
            color: #333;
        }

        .amount-label {
            color: #666;
            font-size: 12px;
        }

        .amount {
            font-size: 26px;
            font-weight: bold;
            margin-top: 15px;
        }

        .details {
            text-align: left;
            margin-top: 15px;
        }

        .row {
            display: table;
            width: 100%;
            margin-bottom: 10px;
        }

        .row span {
            display: table-cell;
        }

        .row span:first-child {
            color: #666;
        }

        .row span:last-child {
            text-align: right;
            font-weight:500;
            color: #000;
        }

        .status {
            color: #16a34a;;
            font-weight: bold; 
        }

        .footer {
            font-size: 10px;
            color: #999;
            margin-top: 10px;
        }
    </style>
</head>

<body>

<div class="container">

    <div class="card">
      
            <div class="watermark-text wm1">{{ ucwords($institutionwatermarkname) }}</div>
            <div class="watermark-text wm2">{{ ucwords($institutionwatermarkname) }}</div>
            <div class="watermark-text wm3">{{ ucwords($institutionwatermarkname) }}</div>
            <div class="watermark-text wm4">{{ ucwords($institutionwatermarkname) }}</div>
            <div class="watermark-text wm5">{{ ucwords($institutionwatermarkname) }}</div>
            <div class="watermark-text wm6">{{ ucwords($institutionwatermarkname) }}</div>
            <div class="watermark-text wm7">{{ ucwords($institutionwatermarkname) }}</div>
        <!-- Logo -->
        <div class="logo">
            <img src="{{ $institution_logo }}" alt="">
        </div>

        <div class="divider"></div>

        <!-- Title -->
        <div class="title">Transaction Receipt</div>

        <!-- Amount -->
        <div style="margin-top: 15px;">
            <div class="amount-label">Amount</div>
            <div class="amount" style="color:{{$receipt['type'] == 'credit' || $receipt['type'] == 'deposit' ? '#16a34a' : '#e22b2b' }}">
                {{$receipt['type'] == 'credit' || $receipt['type'] == 'deposit' ? '+' : '-'}} ₦{{ number_format($receipt['amount'], 2) }}
            </div>
        </div>

        <!-- Details -->
        <div class="details">

                @php
                $beneficiary = explode('-',$receipt['beneficiary']);
            @endphp

            <div class="row">
                <span>Transaction ID</span>
                <span>{{$receipt['reference_no']}}</span>
            </div>

            <div class="row">
                <span>Date</span>
                <span>{{date('M d, Y',strtotime($receipt['created_at']))}} | {{date('h:i A',strtotime($receipt['created_at']))}}</span>
            </div>

               @if (isset($receipt['sessionid']) && !is_null($receipt['sessionid']))
                <div class="row">
                    <span>SessionID</span>
                    <span>{{$receipt['sessionid']}}</span>
                </div>
            @endif
         

            <div class="row">
                <span>Sender</span>
                <span style="word-break: break-all !important">
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

            <div class="row">
                <span>Receiver</span>
                <span style="word-break: break-all !important">
                    {{$receipt['type'] == 'credit' || $receipt['type'] == 'deposit' ? ucwords(session('details')['name'] ?? "") : (isset($beneficiary[0]) ? ucwords($beneficiary[0])." | ".$beneficiary[1] : "") }}
                </span>
            </div>

              @isset($beneficiary[2])
            <div class="row">
                <span>Bank</span>
                <span>{{ucwords($beneficiary[2])}}</span>
            </div>
            @endisset

            <div class="row">
                <span>Transaction Type</span>
                <span class="status">
                    {{ $receipt['type'] == 'credit' || $receipt['type'] == 'deposit' ? 'Credit' : 'Debit'}}
                </span>
            </div>  
            
            <div class="row">
                <span>Status</span>
                <span class="status">
                    {{ $receipt["status"] == "approved" ? 'Success' : ($receipt["status"] == "processing" ? 'Processing' : $receipt["status"])}}
                </span>
            </div>

             <div class="row">
                    <span>Narration</span>
                   <span style="word-break: break-all !important">
                    {!! $receipt['notes'] !!}
                </span>
           </div>

        </div>

        <div class="divider"></div>

        <!-- Footer -->
        <div class="footer">
            Powered by {{ ucwords($institutionname) }} • Secure Payment
        </div>

    </div>

</div>

</body>
</html>