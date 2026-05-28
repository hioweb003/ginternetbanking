<?php

use App\Http\Controllers\PagemgmtController;
use App\Livewire\Auth\ConfirmOtp;
use App\Livewire\Auth\Forgetpassword;
use App\Livewire\Auth\Register;
use App\Livewire\Auth\Resetpassword;
use Illuminate\Support\Facades\Route;


Route::domain('{institution}.'.env('APP_DOMAIN'))->group(function () {

   Route::middleware(["tenant"])->group(function(){

        //Route::get('/', [PagemgmtController::class, 'index'])->name('home');

        Route::livewire('/', 'auth.login')->name('home');
         
        Route::get('/create-account',Register::class)->name('create.account');
        Route::get('/account-forget-password',Forgetpassword::class)->name('account.forgetpasswrd');
        Route::get('/account-verfy-otp',ConfirmOtp::class)->name('account.confrimotp');
        Route::get('/account-reset-password',Resetpassword::class)->name('account.resetpassword');

        Route::get('/user/logout', [PagemgmtController::class, 'Logout'])->name('userlogout');
        Route::get('/download-transaction-receipt', [PagemgmtController::class, 'downloadReceipt'])->name('dwolodrecpt');

        Route::livewire('/dashboard', 'pages::dashboard')->name('dashboard');
        Route::livewire('/bank-transfer', 'pages::banktransfer')->name('banktransfer');
        Route::livewire('/wallet-transfer', 'pages::wallettransfer')->name('wallettransfer');
        Route::livewire('/buy-airtime', 'pages::airtime')->name('airtime');
        Route::livewire('/buy-data', 'pages::data')->name('buydata');
        Route::livewire('/cable-subcription', 'pages::cabletv')->name('cabletv');
        Route::livewire('/buy-electricity', 'pages::electricity')->name('electy');
        Route::livewire('/profile', 'pages::profile')->name('userprofile');
        Route::livewire('/transaction-history', 'pages::transactionhistory')->name('trxshity');
        Route::livewire('/transaction-receipt', 'pages::transactionreceipt')->name('trxreceipt');
        Route::livewire('/manage-beneficiary', 'pages::beneficiary')->name('beneficiary');
        Route::livewire('/services', 'pages::services')->name('servces');
        Route::livewire('/manage-menu', 'pages::menu')->name('muen');
        Route::livewire('/transfer-success','pages::transfersuccess')->name('transfer-success');
        Route::livewire('/transfer-error','pages::transfererror')->name('transfer-error');

        Route::livewire('/profile/details','pages::innerprofile.index')->name('user-profile-details');
        Route::livewire('/profile/change-password','pages::innerprofile.changepassword')->name('change-password');
        Route::livewire('/profile/change-pin','pages::innerprofile.changepin')->name('change-pin');
        Route::livewire('/profile/beneficiary','pages::innerprofile.beneficiary')->name('benfiy');
        Route::livewire('/profile/statement','pages::innerprofile.statement')->name('statement');

   });

});

  
    
   Route::prefix('admin-gcore')->group(function(){

     Route::get('/login',[PagemgmtController::class,'AdminLogin'])->name('login');
     Route::get('/logout',[PagemgmtController::class,'AdminLogout'])->name('logout');

      Route::middleware('auth')->group(function(){
          Route::livewire('/dashboard','admin.dashboard')->name('ad.dashboard');
          Route::livewire('/manage-institution','admin.manage_institution')->name('manage.intst');
          Route::livewire('/create-institution','admin.create_institution')->name('add.intst');
          Route::livewire('/institution/{id}/edit','admin.edit_institution')->name('edit.intst');
          Route::livewire('/manage-user','admin.users')->name('manage.users');
          Route::livewire('/change-password','admin.change_password')->name('changepass');
      });
   });