<?php

namespace App\Http\Controllers;

use App\Models\Institution;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use EragLaravelPwa\Facades\PWA;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;

class PagemgmtController extends Controller
{
    public function index(Request $r)
    {
          //$r->institution;
        $tenant = app('tenant');

     
    //    $getinst = Institution::where('name', $tenant->name)->firstOrFail();

        if ($tenant->status == 1) {

            $logo = app()->environment('production')
                ? url(env('STORAGE_PATH') . $tenant->logo)
                : asset('storage/' . $tenant->logo);

            PWA::update([
                'name' => $tenant->name,
                'short_name' => $this->shortName($tenant->name),
                'background_color' => $tenant->color_one,
                'display' => 'fullscreen',
                'description' => 'A secure and reliable digital banking platform that enables customers to manage accounts, perform transactions, and access financial services anytime, anywhere.',
                'theme_color' => $tenant->color_one,
                'icons' => [
                    [
                        'src' => $logo,
                        'sizes' => '512x512',
                        'type' => 'image/png',
                    ],
                ],
            ]);

            
            return view('welcome', [
                 'institution_code' => $tenant->code,
                'institution_color' => $tenant->color_one,
                'institution_logo' => $logo,
            ]);

        }

            abort(403, 'Institution inactive');
        
        
        // return view('welcome');   
        
       
    }

    public function AdminLogin(){
         return view("login-admin");   
    } 
    
    public function AdminLogout(){

            Auth::logout();
            session()->invalidate();

        return redirect()->route('login');   
    } 
    
    public function Logout(){

            Auth::logout();
            session()->flush();
            session()->invalidate();

        return redirect("/");   
    }


public function shortName($name)
{
    $words = explode(' ', $name);
    $initials = '';

    foreach ($words as $word) {
        $initials .= strtoupper($word[0]);
    }

    return $initials;
}

public function downloadReceipt(){

$recpt = Crypt::decryptString(request()->recept); 

$receipt = json_decode($recpt,true);

             $pdf = Pdf::loadView('receipt', [
                'institutionname' => app('tenant')->fullname,
                'institution_logo' => app('tenant')->logo,
                'receipt' =>  $receipt
             ]);

            return $pdf->download('receipt.pdf');

    }

}//endclass
